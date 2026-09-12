@extends('layouts.utama')

@section('judul', 'Cek Status Pendaftaran')

@section('konten')
    <div class="auth-shell">
        <div class="auth-card shadow-lg rounded-4 overflow-hidden mx-auto" style="max-width: 480px;">
            <div class="bg-white p-4 p-md-5">
                <div class="mb-4">
                    <x-logo light />
                </div>

                <h4 class="fw-bold mb-1">Cek Status Pendaftaran</h4>
                <p class="text-muted mb-4">Masukkan kode pendaftaran yang Anda terima setelah mengirim formulir.</p>

                <form method="POST" action="{{ route('pendaftaran.status.cek') }}">
                    @csrf
                    <x-input name="kode_pendaftaran" label="Kode Pendaftaran" icon="bi-upc-scan" required autofocus />

                    <button type="submit" class="btn btn-brand w-100 py-2 mt-2">
                        <i class="bi bi-search me-1"></i>Cek Status
                    </button>
                </form>

                <a href="{{ route('login') }}" class="small text-decoration-none d-inline-block mt-4">
                    <i class="bi bi-arrow-left me-1"></i>Kembali ke halaman masuk
                </a>
            </div>
        </div>
    </div>
@endsection