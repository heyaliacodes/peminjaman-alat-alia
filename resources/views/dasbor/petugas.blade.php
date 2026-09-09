@extends('layouts.utama')

@section('judul', 'Dasbor Petugas')

@section('konten')
    <div class="mb-4">
        <h4 class="fw-bold mb-1">Dasbor Petugas</h4>
        <p class="text-muted mb-0">Selamat datang, {{ auth()->user()->nama }}. Berikut antrian kerja Anda hari ini.</p>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-sm-6 col-xl-4">
            <x-stat-card icon="bi-clipboard-check" label="Antrian Persetujuan" :value="$notifikasi['antrian_persetujuan'] ?? 0" variant="warning" />
        </div>
        <div class="col-sm-6 col-xl-4">
            <x-stat-card icon="bi-arrow-return-left" label="Antrian Verifikasi Pengembalian" :value="$notifikasi['antrian_verifikasi'] ?? 0" variant="danger" />
        </div>
    </div>

    <h6 class="text-uppercase text-muted small fw-bold mb-3">Akses Cepat</h6>
    <div class="row g-3">
        @can('peminjaman.setujui')
            <div class="col-md-6 col-xl-4">
                <x-shortcut-card icon="bi-clipboard-check" title="Antrian Persetujuan" description="Tinjau dan setujui pengajuan peminjaman." href="{{ route('persetujuan.antrian') }}" variant="warning" />
            </div>
        @endcan
        @can('pengembalian.pantau')
            <div class="col-md-6 col-xl-4">
                <x-shortcut-card icon="bi-eye" title="Pemantauan Peminjaman" description="Pantau seluruh alat yang sedang dipinjam." href="{{ route('pengembalian.pantau') }}" variant="info" />
            </div>
            <div class="col-md-6 col-xl-4">
                <x-shortcut-card icon="bi-arrow-return-left" title="Verifikasi Pengembalian" description="Verifikasi kondisi alat dan hitung denda." href="{{ route('pengembalian.antrian') }}" variant="danger" />
            </div>
        @endcan
        @can('laporan.cetak')
            <div class="col-md-6 col-xl-4">
                <x-shortcut-card icon="bi-file-earmark-bar-graph" title="Cetak Laporan" description="Unduh laporan peminjaman, pengembalian, dan stok." href="{{ route('laporan.form') }}" variant="dark" />
            </div>
        @endcan
    </div>
@endsection