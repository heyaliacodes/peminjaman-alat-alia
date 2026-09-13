<?php

namespace App\Services;

use App\Enums\StatusPeminjaman;
use App\Models\Alat;
use App\Models\Kategori;
use App\Models\Peminjaman;

class RingkasanPublikService
{
    public function ringkasan(): array
    {
        return [
            'total_alat'               => Alat::count(),
            'total_kategori'           => Kategori::count(),
            'total_peminjaman_selesai' => Peminjaman::where('status', StatusPeminjaman::Selesai)->count(),
        ];
    }
}