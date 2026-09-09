@extends('layouts.utama')

@section('judul', 'Dasbor Admin')

@section('konten')
    <div class="d-flex flex-wrap justify-content-between align-items-end mb-4 gap-2">
        <div>
            <h4 class="fw-bold mb-1">Dasbor Admin</h4>
            <p class="text-muted mb-0">Ringkasan operasional sistem peminjaman alat.</p>
        </div>
        <span class="badge bg-primary-subtle text-primary px-3 py-2 rounded-pill">
            <i class="bi bi-person-badge me-1"></i>{{ auth()->user()->nama }}
        </span>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-sm-6 col-xl-3">
            <x-stat-card icon="bi-box-seam" label="Total Alat Terdaftar" :value="$ringkasan['total_alat']" variant="primary" />
        </div>
        <div class="col-sm-6 col-xl-3">
            <x-stat-card icon="bi-people" label="Pengguna Aktif" :value="$ringkasan['total_pengguna_aktif']" variant="info" />
        </div>
        <div class="col-sm-6 col-xl-3">
            <x-stat-card icon="bi-hourglass-split" label="Menunggu Persetujuan" :value="$ringkasan['menunggu_persetujuan']" variant="warning" />
        </div>
        <div class="col-sm-6 col-xl-3">
            <x-stat-card icon="bi-arrow-return-left" label="Menunggu Verifikasi" :value="$ringkasan['menunggu_verifikasi']" variant="danger" />
        </div>
    </div>

    <h6 class="text-uppercase text-muted small fw-bold mb-3">Akses Cepat</h6>
    <div class="row g-3">
        @can('kategori.kelola')
            <div class="col-md-6 col-xl-4">
                <x-shortcut-card icon="bi-tags" title="Kelola Kategori" description="Atur kategori alat lab dan perkakas." href="{{ route('kategori.index') }}" variant="primary" />
            </div>
        @endcan
        @can('alat.kelola')
            <div class="col-md-6 col-xl-4">
                <x-shortcut-card icon="bi-box-seam" title="Kelola Alat" description="Tambah, ubah, dan pantau stok alat." href="{{ route('alat.index') }}" variant="primary" />
            </div>
        @endcan
        @can('user.kelola')
            <div class="col-md-6 col-xl-4">
                <x-shortcut-card icon="bi-people" title="Kelola Pengguna" description="Kelola akun admin, petugas, dan peminjam." href="{{ route('pengguna.index') }}" variant="info" />
            </div>
        @endcan
        @can('peminjaman.kelola')
            <div class="col-md-6 col-xl-4">
                <x-shortcut-card icon="bi-pencil-square" title="Koreksi Peminjaman" description="Perbaiki data peminjaman yang keliru." href="{{ route('koreksi.peminjaman.daftar') }}" variant="secondary" />
            </div>
        @endcan
        @can('pengembalian.kelola')
            <div class="col-md-6 col-xl-4">
                <x-shortcut-card icon="bi-pencil-square" title="Koreksi Pengembalian" description="Perbaiki data pengembalian yang keliru." href="{{ route('koreksi.pengembalian.daftar') }}" variant="secondary" />
            </div>
        @endcan
        @can('log.lihat')
            <div class="col-md-6 col-xl-4">
                <x-shortcut-card icon="bi-journal-code" title="Log Aktivitas" description="Telusuri jejak aktivitas seluruh pengguna." href="{{ route('log.index') }}" variant="dark" />
            </div>
        @endcan
        @can('pengaturan.kelola')
            <div class="col-md-6 col-xl-4">
                <x-shortcut-card icon="bi-gear" title="Pengaturan Sistem" description="Atur tarif denda dan batas hari pinjam." href="{{ route('pengaturan.form') }}" variant="dark" />
            </div>
        @endcan
    </div>
@endsection