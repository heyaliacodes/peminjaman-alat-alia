<?php

namespace App\Policies;

use App\Enums\StatusPeminjaman;
use App\Models\DetailPeminjaman;
use App\Models\User;

class UlasanAlatPolicy
{
    public function create(User $pengguna, DetailPeminjaman $detail): bool
    {
        $peminjaman = $detail->peminjaman;

        if ($peminjaman->user_id !== $pengguna->id) {
            return false;
        }

        if ($peminjaman->status !== StatusPeminjaman::Selesai) {
            return false;
        }

        return $detail->ulasan === null;
    }
}