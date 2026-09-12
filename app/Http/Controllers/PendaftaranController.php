<?php

namespace App\Http\Controllers;

use App\Enums\StatusPendaftaran;
use App\Http\Requests\PendaftaranRequest;
use App\Models\PendaftaranAkun;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PendaftaranController extends Controller
{
    public function form()
    {
        return view('pendaftaran.form');
    }

    public function simpan(PendaftaranRequest $request)
    {
        $pendaftaran = PendaftaranAkun::create([
            'kode_pendaftaran' => $this->buatKodePendaftaran(),
            'nama'             => $request->nama,
            'username'         => $request->username,
            'email'            => $request->email,
            'no_telp'          => $request->no_telp,
            'password'         => $request->password,
            'status'           => StatusPendaftaran::Menunggu,
        ]);

        return view('pendaftaran.selesai', compact('pendaftaran'));
    }

    public function statusForm()
    {
        return view('pendaftaran.status-form');
    }

    public function statusCek(Request $request)
    {
        $request->validate([
            'kode_pendaftaran' => ['required', 'string'],
        ]);

        $pendaftaran = PendaftaranAkun::where('kode_pendaftaran', $request->kode_pendaftaran)->first();

        if (! $pendaftaran) {
            return back()
                ->withInput()
                ->withErrors(['kode_pendaftaran' => 'Kode pendaftaran tidak ditemukan.']);
        }

        return view('pendaftaran.status', compact('pendaftaran'));
    }

    private function buatKodePendaftaran(): string
    {
        do {
            $kode = 'DAF-' . Str::upper(Str::random(8));
        } while (PendaftaranAkun::where('kode_pendaftaran', $kode)->exists());

        return $kode;
    }
}