<?php

namespace App\Services;

use App\Enums\StatusPeminjaman;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use App\Models\User;

class StatistikPeminjamService
{
    public function ringkasan(User $peminjam): array
    {
        $totalPinjam = Peminjaman::where('user_id', $peminjam->id)
            ->where('status', StatusPeminjaman::Selesai)
            ->count();

        $daftarPengembalian = Pengembalian::whereHas('peminjaman', function ($query) use ($peminjam) {
                $query->where('user_id', $peminjam->id);
            })
            ->get(['hari_terlambat', 'total_denda']);

        $totalTransaksi = $daftarPengembalian->count();

        $persenTepatWaktu = $totalTransaksi > 0
            ? round($daftarPengembalian->where('hari_terlambat', 0)->count() / $totalTransaksi * 100)
            : null;

        return [
            'total_pinjam'       => $totalPinjam,
            'persen_tepat_waktu' => $persenTepatWaktu,
            'total_denda'        => $daftarPengembalian->sum('total_denda'),
        ];
    }
}