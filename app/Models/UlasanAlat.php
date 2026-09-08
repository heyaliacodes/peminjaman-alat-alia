<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UlasanAlat extends Model
{
    protected $table = 'ulasan_alat';

    protected $fillable = [
        'detail_peminjaman_id',
        'alat_id',
        'user_id',
        'rating',
        'komentar',
    ];

    public function detailPeminjaman()
    {
        return $this->belongsTo(DetailPeminjaman::class, 'detail_peminjaman_id');
    }

    public function alat()
    {
        return $this->belongsTo(Alat::class, 'alat_id');
    }

    public function peminjam()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}