<?php

namespace App\Services;

use App\Enums\StatusPeminjaman;
use App\Models\Alat;
use App\Models\Peminjaman;
use App\Models\User;

class RingkasanAdminService
{
    public function ringkasan(): array
    {
        $totalStok = Alat::sum('stok');
        $totalStokTersedia = Alat::sum('stok_tersedia');

        return [
            'total_alat'              => Alat::count(),
            'total_pengguna_aktif'    => User::where('is_aktif', true)->count(),
            'menunggu_persetujuan'    => Peminjaman::where('status', StatusPeminjaman::Diajukan)->count(),
            'menunggu_verifikasi'     => Peminjaman::where('status', StatusPeminjaman::MenungguVerifikasi)->count(),
            'persentase_ketersediaan' => $totalStok > 0
                ? (int) min(100, round($totalStokTersedia / $totalStok * 100))
                : null,
        ];
    }
}