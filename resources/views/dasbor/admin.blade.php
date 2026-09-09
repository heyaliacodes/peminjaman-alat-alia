@extends('layouts.admin')

@section('judul', 'Dasbor Admin')

@section('konten')
    <div class="dasbor-hero">
        <div>
            <h4><x-sapaan-waktu />, {{ auth()->user()->nama }}</h4>
            <p>Ringkasan operasional sistem peminjaman alat hari ini.</p>
        </div>
        <div class="dasbor-hero__meta">
            <i class="bi bi-calendar3"></i>
            {{ now()->translatedFormat('l, d F Y') }}
        </div>
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

    @php
        $variantKetersediaan = match(true) {
            is_null($ringkasan['persentase_ketersediaan']) => 'secondary',
            $ringkasan['persentase_ketersediaan'] >= 50 => 'success',
            $ringkasan['persentase_ketersediaan'] >= 20 => 'warning',
            default => 'danger',
        };
    @endphp

    <div class="row g-3">
        <div class="col-lg-6">
            <x-progress-stat
                label="Ketersediaan Alat Keseluruhan"
                :persen="$ringkasan['persentase_ketersediaan']"
                :variant="$variantKetersediaan"
                keterangan="Perbandingan total stok tersedia terhadap seluruh stok alat yang terdaftar." />
        </div>
    </div>
@endsection