<?php

namespace App\Providers;

use App\Http\Responses\LoginResponse;
use App\Models\LogAktivitas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\ValidationException;
use Laravel\Fortify\Contracts\LoginResponse as KontrakLoginResponse;
use Laravel\Fortify\Fortify;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(KontrakLoginResponse::class, LoginResponse::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Fortify::username('username');

        Fortify::loginView(fn () => view('auth.login'));

        Fortify::authenticateUsing(function (Request $request) {
            return $this->periksaKredensial($request);
        });

        RateLimiter::for('login', function (Request $request) {
            // Karena Anda menggunakan username untuk login:
            $identifier = (string) $request->username;

            // Batasi 5 kali percobaan gagal per menit berdasarkan username dan IP address
            return Limit::perMinute(5)->by($identifier . $request->ip());
        });
    }

    private function periksaKredensial(Request $request): ?User
    {
        $pengguna = User::where('username', $request->username)->first();

        // Cabang 1: user tidak ditemukan atau password tidak cocok.
        if (! $pengguna || ! Hash::check($request->password, $pengguna->password)) {
            $this->catatLoginGagal($request);

            return null;
        }

        // Cabang 2: user ditemukan tetapi akunnya dinonaktifkan.
        if (! $pengguna->is_aktif) {
            $this->catatLoginGagal($request, $pengguna->id);

            throw ValidationException::withMessages([
                'username' => 'Akun Anda dinonaktifkan. Hubungi administrator.'
            ]);
        }

        // Cabang 3: kredensial cocok dan akun aktif.
        LogAktivitas::create([
            'user_id'      => $pengguna->id,
            'aksi'         => 'login',
            'tabel_tujuan' => 'users',
            'deskripsi'    => 'Pengguna ' . $pengguna->username . ' berhasil masuk',
            'ip_address'   => $request->ip(),
        ]);

        return $pengguna;
    }

    private function catatLoginGagal(Request $request, ?int $penggunaId = null): void
    {
        LogAktivitas::create([
            'user_id'      => $penggunaId,
            'aksi'         => 'login_gagal',
            'tabel_tujuan' => 'users',
            'deskripsi'    => 'Percobaan masuk gagal untuk username ' . $request->username,
            'ip_address'   => $request->ip(),
        ]);
    }
}