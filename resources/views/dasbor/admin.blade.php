@extends('layouts.utama')

@section('judul', 'Dasbor Admin')

@section('konten')
    <h4>Dasbor Admin</h4>
    <p class="text-muted">Selamat Datang, {{ auth()->user()->nama }}.</p>
@endsection