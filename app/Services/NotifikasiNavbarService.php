<?php

namespace App\Services;

use App\Enums\StatusPeminjaman;
use App\Models\Peminjaman;
use App\Models\User;

class NotifikasiNavbarService
{
    public function untukPengguna(User $pengguna): array
    {
        return [
            'antrian_persetujuan' => $pengguna->can('peminjaman.setujui')
                ? Peminjaman::where('status', StatusPeminjaman::Diajukan)->count()
                : null,

            'antrian_verifikasi' => $pengguna->can('pengembalian.pantau')
                ? Peminjaman::where('status', StatusPeminjaman::MenungguVerifikasi)->count()
                : null,

            'jatuh_tempo_saya' => Peminjaman::where('user_id', $pengguna->id)
                ->where('status', StatusPeminjaman::Dipinjam)
                ->whereDate('tgl_harus_kembali', '<=', now()->addDay())
                ->count(),
        ];
    }
}