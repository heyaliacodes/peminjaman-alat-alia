<?php

namespace App\Models;

use App\Enums\StatusPendaftaran;
use Illuminate\Database\Eloquent\Model;

class PendaftaranAkun extends Model
{
    protected $table = 'pendaftaran_akun';

    protected $fillable = [
        'kode_pendaftaran', 'nama', 'username', 'email', 'no_telp',
        'password', 'status', 'alasan_penolakan', 'diproses_oleh', 'diproses_pada',
    ];

    protected function casts(): array
    {
        return [
            'status'        => StatusPendaftaran::class,
            'password'      => 'hashed',
            'diproses_pada' => 'datetime',
        ];
    }

    public function diprosesOleh()
    {
        return $this->belongsTo(User::class, 'diproses_oleh');
    }
}