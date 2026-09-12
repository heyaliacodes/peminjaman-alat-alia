@extends('layouts.utama')

@section('judul', 'Status Pendaftaran')

@section('konten')
    <div class="auth-shell">
        <div class="auth-card shadow-lg rounded-4 overflow-hidden mx-auto" style="max-width: 520px;">
            <div class="bg-white p-4 p-md-5">
                <h4 class="fw-bold mb-1">Status Pendaftaran</h4>
                <p class="text-muted mb-4">Kode: <strong>{{ $pendaftaran->kode_pendaftaran }}</strong></p>

                @if ($pendaftaran->status->value === 'menunggu')
                    <div class="alert alert-warning border-0 d-flex align-items-center gap-2">
                        <i class="bi bi-hourglass-split fs-5"></i>
                        <div>Pendaftaran Anda sedang menunggu verifikasi admin. Silakan cek kembali secara berkala.</div>
                    </div>
                @elseif ($pendaftaran->status->value === 'diterima')
                    <div class="alert alert-success border-0 d-flex align-items-center gap-2">
                        <i class="bi bi-check-circle-fill fs-5"></i>
                        <div>Selamat! Pendaftaran Anda diterima. Akun sudah bisa dipakai untuk masuk.</div>
                    </div>
                    <a href="{{ route('login') }}" class="btn btn-brand w-100 py-2 mt-2">
                        <i class="bi bi-box-arrow-in-right me-1"></i>Masuk Sekarang
                    </a>
                @else
                    <div class="alert alert-danger border-0 d-flex align-items-start gap-2">
                        <i class="bi bi-x-circle-fill fs-5"></i>
                        <div>
                            Mohon maaf, pendaftaran Anda belum bisa diterima.
                            @if ($pendaftaran->alasan_penolakan)
                                <div class="mt-2"><strong>Alasan:</strong> {{ $pendaftaran->alasan_penolakan }}</div>
                            @endif
                        </div>
                    </div>
                    <a href="{{ route('pendaftaran.form') }}" class="btn btn-outline-secondary w-100 py-2 mt-2">
                        Daftar Ulang
                    </a>
                @endif

                <a href="{{ route('login') }}" class="small text-decoration-none d-inline-block mt-4">
                    <i class="bi bi-arrow-left me-1"></i>Kembali ke halaman masuk
                </a>
            </div>
        </div>
    </div>
@endsection