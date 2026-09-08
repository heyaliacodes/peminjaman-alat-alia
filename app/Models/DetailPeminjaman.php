<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailPeminjaman extends Model
{
    protected $table = 'detail_peminjaman';

    protected $fillable = [
        'peminjaman_id', 'alat_id', 'jumlah', 'kondisi_kembali', 'denda',
    ];

    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class, 'peminjaman_id');
    }

    public function alat()
    {
        return $this->belongsTo(Alat::class, 'alat_id');
    }

    public function ulasan()
    {
        return $this->hasOne(UlasanAlat::class, 'detail_peminjaman_id');
    }
}

