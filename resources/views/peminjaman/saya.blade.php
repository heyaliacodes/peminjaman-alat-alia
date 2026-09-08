@extends('layouts.utama')
@section('judul', 'Pinjaman Saya')
@section('konten')
<h4 class="mb-3">Pinjaman Saya</h4>

@include('peminjaman.statistik-pribadi')

    @if ($jumlahJatuhTempo > 0)
        <div class="alert alert-warning">
            Anda punya {{ $jumlahJatuhTempo }} peminjaman yang jatuh tempo besok atau sudah terlambat.
            Periksa tabel di bawah dan segera ajukan pengembalian.
        </div>
    @endif

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            @include('peminjaman.tabel-pinjam')
        </div>

        {{ $daftarPeminjaman->links() }}
    </div>
</div>
@endsection
