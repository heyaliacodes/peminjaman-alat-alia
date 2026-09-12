@extends('layouts.utama')

@section('judul', 'Pendaftaran Terkirim')

@section('konten')
    <div class="auth-shell">
        <div class="auth-card shadow-lg rounded-4 overflow-hidden mx-auto" style="max-width: 520px;">
            <div class="bg-white p-4 p-md-5 text-center">
                <div class="mb-3">
                    <span class="icon-tile bg-success-subtle text-success mx-auto" style="width:64px;height:64px;font-size:1.75rem;">
                        <i class="bi bi-check-lg"></i>
                    </span>
                </div>

                <h4 class="fw-bold mb-2">Pendaftaran Berhasil Dikirim</h4>
                <p class="text-muted mb-4">
                    Admin sekolah akan meninjau data Anda. Simpan kode di bawah ini untuk memantau statusnya.
                </p>

                <div class="border rounded-3 p-3 mb-4 bg-light">
                    <div class="small text-muted mb-1">Kode Pendaftaran Anda</div>
                    <div class="fs-4 fw-bold text-brand" style="letter-spacing: .1em;">{{ $pendaftaran->kode_pendaftaran }}</div>
                </div>

                <a href="{{ route('pendaftaran.status.form') }}" class="btn btn-brand w-100 py-2 mb-2">
                    <i class="bi bi-search me-1"></i>Cek Status Sekarang
                </a>
                <a href="{{ route('login') }}" class="btn btn-outline-secondary w-100 py-2">
                    Kembali ke Halaman Masuk
                </a>
            </div>
        </div>
    </div>
@endsection