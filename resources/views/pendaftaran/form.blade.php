@extends('layouts.utama')

@section('judul', 'Daftar Akun Peminjam')

@section('konten')
    <div class="auth-shell">
        <div class="row g-0 auth-card shadow-lg rounded-4 overflow-hidden mx-auto">

            <div class="col-lg-5 d-none d-lg-flex auth-brand-panel">
                <div class="p-5 d-flex flex-column justify-content-between h-100 w-100">
                    <x-logo />

                    <div>
                        <h2 class="fw-bold text-white mb-3">Daftar Sebagai Peminjam</h2>
                        <p class="text-white-50 mb-4">
                            Lengkapi data diri Anda. Admin sekolah akan meninjau pendaftaran
                            sebelum akun Anda bisa dipakai untuk masuk.
                        </p>

                        <ul class="list-unstyled auth-feature-list">
                            <li><i class="bi bi-check2-circle"></i> Isi formulir sendiri, tanpa perlu menemui admin</li>
                            <li><i class="bi bi-check2-circle"></i> Dapatkan kode untuk memantau status pendaftaran</li>
                            <li><i class="bi bi-check2-circle"></i> Langsung bisa masuk begitu diverifikasi</li>
                        </ul>
                    </div>

                    <p class="text-white-50 small mb-0">&copy; {{ date('Y') }} SMP Plus Manba'ul Huda Padaherang</p>
                </div>
            </div>

            <div class="col-lg-7 bg-white">
                <div class="p-4 p-md-5">
                    <div class="d-lg-none mb-4">
                        <x-logo light />
                    </div>

                    <h4 class="fw-bold mb-1">Formulir Pendaftaran Akun</h4>
                    <p class="text-muted mb-4">Isi data berikut sesuai identitas Anda yang sebenarnya.</p>

                    <form method="POST" action="{{ route('pendaftaran.simpan') }}">
                        @csrf

                        <div class="row">
                            <div class="col-md-6">
                                <x-input name="nama" label="Nama Lengkap" icon="bi-person" required autofocus />
                            </div>
                            <div class="col-md-6">
                                <x-input name="username" label="Nama Pengguna" icon="bi-at" required />
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <x-input name="email" label="Email" type="email" icon="bi-envelope" />
                            </div>
                            <div class="col-md-6">
                                <x-input name="no_telp" label="Nomor HP/WhatsApp" icon="bi-telephone" />
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <x-input name="password" label="Kata Sandi" type="password" icon="bi-lock" required value="" />
                            </div>
                            <div class="col-md-6">
                                <x-input name="password_confirmation" label="Ulangi Kata Sandi" type="password" icon="bi-lock" required value="" />
                            </div>
                        </div>

                        <button type="submit" class="btn btn-brand w-100 py-2 mt-2">
                            <i class="bi bi-send-check me-1"></i>Kirim Pendaftaran
                        </button>
                    </form>

                    <div class="d-flex flex-wrap justify-content-between gap-2 mt-4">
                        <a href="{{ route('login') }}" class="small text-decoration-none">
                            <i class="bi bi-arrow-left me-1"></i>Sudah punya akun? Masuk
                        </a>
                        <a href="{{ route('pendaftaran.status.form') }}" class="small text-decoration-none">
                            Cek status pendaftaran <i class="bi bi-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection