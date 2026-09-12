<?php

namespace App\Enums;

enum StatusPendaftaran: string
{
    case Menunggu = 'menunggu';
    case Diterima = 'diterima';
    case Ditolak  = 'ditolak';
}