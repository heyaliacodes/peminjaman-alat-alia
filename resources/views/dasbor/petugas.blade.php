@extends('layouts.utama')

@section('judul', 'Dasbor Petugas')

@section('konten')
    <div class="dasbor-hero">
        <div>
            <h4><x-sapaan-waktu />, {{ auth()->user()->nama }}</h4>
            <p>Berikut antrian kerja Anda hari ini.</p>
        </div>
        <div class="dasbor-hero__meta">
            <i class="bi bi-calendar3"></i>
            {{ now()->translatedFormat('l, d F Y') }}
        </div>
    </div>

    <div class="row g-3">
        <div class="col-md-6">
            <x-stat-card icon="bi-clipboard-check" label="Antrian Persetujuan" :value="$notifikasi['antrian_persetujuan'] ?? 0" variant="warning" />
        </div>
        <div class="col-md-6">
            <x-stat-card icon="bi-arrow-return-left" label="Antrian Verifikasi Pengembalian" :value="$notifikasi['antrian_verifikasi'] ?? 0" variant="danger" />
        </div>
    </div>
@endsection