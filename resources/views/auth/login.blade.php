@extends('layouts.utama')

@section('judul', 'Masuk — Peminjaman Alat')

@section('konten')
    <div class="auth-shell">
        <div class="row g-0 auth-card shadow-lg rounded-4 overflow-hidden mx-auto">

            <div class="col-lg-6 d-none d-lg-flex auth-brand-panel">
                <div class="p-5 d-flex flex-column justify-content-between h-100 w-100">
                    <x-logo />

                    <div>
                        <h2 class="fw-bold text-white mb-3">Kelola Peminjaman Alat Sekolah dalam Satu Sistem</h2>
                        <p class="text-white-50 mb-4">
                            Ajukan peminjaman, pantau tenggat waktu, dan lihat riwayat Anda —
                            semuanya tercatat rapi dan bisa diakses kapan saja.
                        </p>

                        <ul class="list-unstyled auth-feature-list">
                            <li><i class="bi bi-check2-circle"></i> Pengajuan peminjaman tanpa kertas</li>
                            <li><i class="bi bi-check2-circle"></i> Notifikasi jatuh tempo otomatis</li>
                            <li><i class="bi bi-check2-circle"></i> Statistik peminjaman pribadi</li>
                        </ul>
                    </div>

                    <p class="text-white-50 small mb-0">&copy; {{ date('Y') }} SMKN 1 Padaherang</p>
                </div>
            </div>

            <div class="col-lg-6 bg-white">
                <div class="p-4 p-md-5">
                    <div class="d-lg-none mb-4">
                        <x-logo light />
                    </div>

                    <h4 class="fw-bold mb-1">Masuk ke Sistem</h4>
                    <p class="text-muted mb-4">Gunakan akun yang sudah didaftarkan oleh admin sekolah.</p>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <x-input name="username" label="Nama Pengguna" icon="bi-person" required autofocus />
                        <x-input name="password" label="Kata Sandi" type="password" icon="bi-lock" required value="" />

                        <button type="submit" class="btn btn-brand w-100 py-2 mt-2">
                            <i class="bi bi-box-arrow-in-right me-1"></i>Masuk
                        </button>
                    </form>

                    <div class="d-grid mt-3">
                        <a href="{{ route('pendaftaran.form') }}" class="btn btn-outline-brand py-2">
                            <i class="bi bi-person-plus me-1"></i>Daftar Akun Peminjam Baru
                        </a>
                    </div>

                    <p class="text-center text-muted small mt-3 mb-0">
                        Sudah pernah mendaftar? <a href="{{ route('pendaftaran.status.form') }}">Cek status pendaftaran</a>.
                        Lupa kata sandi? Hubungi admin sekolah untuk mengatur ulang.
                    </p>
                    
                </div>
            </div>

        </div>
    </div>
@endsection