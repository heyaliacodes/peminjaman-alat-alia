@extends('layouts.utama')

@section('judul', 'Dasbor Peminjam')

@section('konten')
    <div class="mb-4">
        <h4 class="fw-bold mb-1">Dasbor Peminjam</h4>
        <p class="text-muted mb-0">Selamat datang, {{ auth()->user()->nama }}. Ini ringkasan peminjaman Anda.</p>
    </div>

    @if ($jumlahJatuhTempo > 0)
        <div class="alert alert-warning d-flex align-items-center gap-2 border-0 shadow-sm">
            <i class="bi bi-exclamation-triangle-fill fs-5"></i>
            <div>
                Anda punya <strong>{{ $jumlahJatuhTempo }}</strong> peminjaman yang jatuh tempo besok atau sudah terlambat.
                <a href="{{ route('peminjaman.saya') }}" class="alert-link">Lihat detail</a>.
            </div>
        </div>
    @endif

    <div class="row g-3 mb-4">
        <div class="col-sm-6 col-xl-3">
            <x-stat-card icon="bi-journal-text" label="Kali Meminjam" :value="$statistik['total_pinjam']" variant="primary" />
        </div>
        <div class="col-sm-6 col-xl-3">
            <x-stat-card icon="bi-stopwatch" label="Tepat Waktu"
                value="{{ $statistik['persen_tepat_waktu'] !== null ? $statistik['persen_tepat_waktu'] . '%' : '-' }}"
                variant="success" />
        </div>
        <div class="col-sm-6 col-xl-3">
            <x-stat-card icon="bi-cash-coin" label="Total Denda"
                value="Rp {{ number_format($statistik['total_denda'], 0, ',', '.') }}"
                variant="secondary" />
        </div>
        <div class="col-sm-6 col-xl-3">
            <x-stat-card icon="bi-bell" label="Jatuh Tempo / Terlambat" :value="$jumlahJatuhTempo" variant="warning" />
        </div>
    </div>

    <h6 class="text-uppercase text-muted small fw-bold mb-3">Akses Cepat</h6>
    <div class="row g-3">
        @can('alat.lihat')
            <div class="col-md-6 col-xl-4">
                <x-shortcut-card icon="bi-grid" title="Jelajahi Katalog Alat" description="Lihat alat yang tersedia untuk dipinjam." href="{{ route('katalog.daftar') }}" variant="primary" />
            </div>
        @endcan
        @can('peminjaman.ajukan')
            <div class="col-md-6 col-xl-4">
                <x-shortcut-card icon="bi-cart-plus" title="Ajukan Peminjaman" description="Lengkapi keperluan dan ajukan peminjaman baru." href="{{ route('peminjaman.ajukan') }}" variant="info" />
            </div>
        @endcan
        <div class="col-md-6 col-xl-4">
            <x-shortcut-card icon="bi-journal-text" title="Pinjaman Saya" description="Pantau status dan riwayat peminjaman Anda." href="{{ route('peminjaman.saya') }}" variant="secondary" />
        </div>
    </div>
@endsection