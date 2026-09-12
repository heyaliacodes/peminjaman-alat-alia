<?php

namespace App\Http\Controllers;

use App\Enums\StatusPendaftaran;
use App\Http\Requests\PenolakanPendaftaranRequest;
use App\Models\PendaftaranAkun;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VerifikasiPendaftaranController extends Controller
{
    public function daftar(Request $request)
    {
        $status = $request->query('status', StatusPendaftaran::Menunggu->value);

        $daftarPendaftaran = PendaftaranAkun::with('diprosesOleh')
            ->where('status', $status)
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('pendaftaran.admin-daftar', compact('daftarPendaftaran', 'status'));
    }

    public function terima(PendaftaranAkun $pendaftaran)
    {
        abort_if(
            $pendaftaran->status !== StatusPendaftaran::Menunggu,
            422,
            'Pendaftaran ini sudah diproses sebelumnya.'
        );

        if (User::where('username', $pendaftaran->username)->exists()) {
            return back()->with(
                'gagal',
                "Nama pengguna '{$pendaftaran->username}' sudah dipakai akun lain. Tolak pendaftaran ini dan minta pendaftar mengganti nama pengguna."
            );
        }

        DB::transaction(function () use ($pendaftaran) {
            $pengguna = User::create([
                'nama'     => $pendaftaran->nama,
                'username' => $pendaftaran->username,
                'email'    => $pendaftaran->email,
                'no_telp'  => $pendaftaran->no_telp,
                'password' => $pendaftaran->password,
                'is_aktif' => true,
            ]);

            $pengguna->syncRoles(['peminjam']);

            $pendaftaran->update([
                'status'        => StatusPendaftaran::Diterima,
                'diproses_oleh' => auth()->id(),
                'diproses_pada' => now(),
            ]);
        });

        return back()->with('sukses', "Pendaftaran {$pendaftaran->nama} diterima. Akun peminjam sudah aktif.");
    }

    public function tolak(PenolakanPendaftaranRequest $request, PendaftaranAkun $pendaftaran)
    {
        abort_if(
            $pendaftaran->status !== StatusPendaftaran::Menunggu,
            422,
            'Pendaftaran ini sudah diproses sebelumnya.'
        );

        $pendaftaran->update([
            'status'            => StatusPendaftaran::Ditolak,
            'alasan_penolakan'  => $request->alasan_penolakan,
            'diproses_oleh'     => auth()->id(),
            'diproses_pada'     => now(),
        ]);

        return back()->with('sukses', "Pendaftaran {$pendaftaran->nama} ditolak.");
    }
}