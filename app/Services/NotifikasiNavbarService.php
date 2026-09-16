<?php

namespace App\Services;

use App\Enums\StatusPeminjaman;
use App\Enums\StatusPendaftaran;
use App\Models\PendaftaranAkun;
use App\Models\Peminjaman;
use App\Models\User;

class NotifikasiNavbarService
{
    public function untukPengguna(User $pengguna): array
    {
        $hariIni = now()->toDateString();
        $besok = now()->addDay()->toDateString();

        return [
            'antrian_persetujuan' => $pengguna->can('peminjaman.setujui')
                ? Peminjaman::where('status', StatusPeminjaman::Diajukan)->count()
                : null,

            'antrian_verifikasi' => $pengguna->can('pengembalian.pantau')
                ? Peminjaman::where('status', StatusPeminjaman::MenungguVerifikasi)->count()
                : null,

            'pendaftaran_menunggu' => $pengguna->can('user.kelola')
                ? PendaftaranAkun::where('status', StatusPendaftaran::Menunggu)->count()
                : null,

            // Peminjaman yang sudah lewat dari tanggal harus kembali (Terlambat)
            'terlambat_saya' => Peminjaman::where('user_id', $pengguna->id)
                ->where('status', StatusPeminjaman::Dipinjam)
                ->whereDate('tgl_harus_kembali', '<', $hariIni)
                ->count(),

            // Peminjaman yang jatuh tempo hari ini atau besok
            'jatuh_tempo_dekat_saya' => Peminjaman::where('user_id', $pengguna->id)
                ->where('status', StatusPeminjaman::Dipinjam)
                ->whereBetween('tgl_harus_kembali', [$hariIni, $besok])
                ->count(),
        ];
    }
}