<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alat extends Model
{
    protected $table = 'alat';

    protected $fillable = [
        'kategori_id', 'kode_alat', 'nama', 'deskripsi',
        'stok', 'stok_tersedia', 'kondisi', 'foto',
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    public function detailPeminjaman()
    {
        return $this->hasMany(DetailPeminjaman::class, 'alat_id');
    }

    public function ulasan()
    {
        return $this->hasMany(UlasanAlat::class, 'alat_id');
    }

    public function getPersentaseTersediaAttribute(): int
    {
        if ($this->stok <= 0) {
            return 0;
        }

        return (int) min(100, round($this->stok_tersedia / $this->stok * 100));
    }

    public function getWarnaStokAttribute(): string
    {
        return match (true) {
            $this->persentase_tersedia >= 50 => 'success',
            $this->persentase_tersedia >= 20 => 'warning',
            default => 'danger',
        };
    }
}

