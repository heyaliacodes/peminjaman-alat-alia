<?php

namespace App\Http\Controllers;

use App\Services\RingkasanPublikService;

class BerandaController extends Controller
{
    public function index(RingkasanPublikService $layananRingkasan)
    {
        if (auth()->check()) {
            return redirect()->route(match (true) {
                auth()->user()->hasRole('admin')   => 'admin.dasbor',
                auth()->user()->hasRole('petugas') => 'petugas.dasbor',
                default                             => 'peminjam.dasbor',
            });
        }

        return view('beranda', [
            'statistik' => $layananRingkasan->ringkasan(),
        ]);
    }
}