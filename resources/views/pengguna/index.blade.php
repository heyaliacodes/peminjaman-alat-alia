@extends('layouts.utama')

@section('judul', 'Kelola Pengguna')

@section('konten')
    <div class="d-flex justify-content-between align-item-center mb-3">
        <h4 class="fw-bold mb-0">Daftar Pengguna</h4>
        <a href="{{ route('pengguna.create') }}" class="btn btn-primary">Tambah Pengguna</a>
    </div>
    <div class="card">
        <div class="card-body">
            @include('pengguna.form-pencarian')
            @include('pengguna.table')
        </div>
    </div>

    <div class="mt-3">
        {{ $daftarPengguna->links() }}
    </div>
@endsection