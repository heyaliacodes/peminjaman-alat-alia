@extends('layouts.utama')

@section('judul', 'Dasbor Peminjam')

@section('konten')
    <div class="dasbor-hero">
        <div>
            <h4><x-sapaan-waktu />, {{ auth()->user()->nama }}</h4>
            <p>Ini ringkasan peminjaman Anda.</p>
        </div>
        <div class="dasbor-hero__meta">
            <i class="bi bi-calendar3"></i>
            {{ now()->translatedFormat('l, d F Y') }}
        </div>
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
        <div class="col-sm-6 col-xl-4">
            <x-stat-card icon="bi-journal-text" label="Kali Meminjam" :value="$statistik['total_pinjam']" variant="primary" />
        </div>
        <div class="col-sm-6 col-xl-4">
            <x-stat-card icon="bi-cash-coin" label="Total Denda"
                value="Rp {{ number_format($statistik['total_denda'], 0, ',', '.') }}"
                variant="secondary" />
        </div>
        <div class="col-sm-6 col-xl-4">
            <x-stat-card icon="bi-bell" label="Jatuh Tempo / Terlambat" :value="$jumlahJatuhTempo" variant="warning" />
        </div>
    </div>

    @php
        $variantTepatWaktu = match(true) {
            is_null($statistik['persen_tepat_waktu']) => 'secondary',
            $statistik['persen_tepat_waktu'] >= 80 => 'success',
            $statistik['persen_tepat_waktu'] >= 50 => 'warning',
            default => 'danger',
        };
    @endphp

    <div class="row g-3">
        <div class="col-lg-6">
            <x-progress-stat
                label="Ketepatan Waktu Pengembalian"
                :persen="$statistik['persen_tepat_waktu']"
                :variant="$variantTepatWaktu"
                keterangan="Dihitung dari seluruh peminjaman Anda yang sudah selesai." />
        </div>
    </div>
@endsection