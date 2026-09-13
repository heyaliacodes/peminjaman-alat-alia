@section('judul', 'Beranda — Sistem Peminjaman Alat SMKN 1 Padaherang')
<!DOCTYPE html>
<html lang="id">
@include('layouts.head')
<body class="bg-app">

    <nav class="navbar navbar-expand-lg navbar-dark navbar-modern sticky-top shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ route('beranda') }}">
            <x-logo />
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menuBeranda">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="menuBeranda">
            <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-3">
                <li class="nav-item"><a class="nav-link" href="#fitur">Fitur</a></li>
                <li class="nav-item"><a class="nav-link" href="#cara-kerja">Cara Kerja</a></li>
                <li class="nav-item"><a class="nav-link" href="#tentang">Tentang</a></li>
                <li class="nav-item ms-lg-2">
                    <a href="{{ route('login') }}" class="btn btn-outline-light btn-sm px-3">Masuk</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('pendaftaran.form') }}" class="btn btn-light btn-sm px-3 text-brand fw-semibold">Daftar</a>
                </li>
            </ul>
        </div>
    </div>
    </nav>

    <main>
        <section class="lp-hero">
            <div class="container">
                <div class="row align-items-center g-5">
                    <div class="col-lg-6">
                        <span class="lp-badge"><i class="bi bi-mortarboard me-1"></i>SMKN 1 Padaherang</span>
                        <h1 class="lp-hero__title">Kelola Peminjaman Alat Sekolah, Tanpa Kertas dan Tanpa Ribet</h1>
                        <p class="lp-hero__desc">
                            Sistem Peminjaman Alat membantu siswa mengajukan pinjaman alat praktik secara daring,
                            memudahkan petugas memverifikasi pengembalian, dan memberi admin kendali penuh atas
                            data alat, pengguna, hingga laporan — semuanya dalam satu tempat.
                        </p>
                        <div class="d-flex flex-wrap gap-2 mt-4">
                            <a href="{{ route('login') }}" class="btn btn-brand btn-lg px-4">
                                <i class="bi bi-box-arrow-in-right me-1"></i>Masuk ke Sistem
                            </a>
                            <a href="{{ route('pendaftaran.form') }}" class="btn btn-outline-brand btn-lg px-4">
                                Daftar sebagai Peminjam
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="lp-preview">
                            <div class="lp-preview__bar"><span></span><span></span><span></span></div>
                            <div class="lp-preview__body">
                                <div class="lp-preview__row">
                                    <i class="bi bi-box-seam"></i>
                                    <div>
                                        <div class="lp-preview__title">Multimeter Digital</div>
                                        <div class="lp-preview__sub">Tersedia 9 dari 12 unit</div>
                                    </div>
                                    <span class="badge bg-success-subtle text-success">Tersedia</span>
                                </div>
                                <div class="lp-preview__row">
                                    <i class="bi bi-box-seam"></i>
                                    <div>
                                        <div class="lp-preview__title">Proyektor Portabel</div>
                                        <div class="lp-preview__sub">Jatuh tempo besok</div>
                                    </div>
                                    <span class="badge bg-warning-subtle text-warning">Segera Kembali</span>
                                </div>
                                <div class="lp-preview__row">
                                    <i class="bi bi-box-seam"></i>
                                    <div>
                                        <div class="lp-preview__title">Tang Crimping RJ45</div>
                                        <div class="lp-preview__sub">Menunggu persetujuan</div>
                                    </div>
                                    <span class="badge bg-primary-subtle text-primary">Diajukan</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="lp-stats-bar">
            <div class="container">
                <div class="row g-4 text-center">
                    <div class="col-6 col-md-3">
                        <div class="lp-stat-value">{{ $statistik['total_alat'] }}+</div>
                        <div class="lp-stat-label">Alat Terdaftar</div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="lp-stat-value">{{ $statistik['total_kategori'] }}</div>
                        <div class="lp-stat-label">Kategori Alat</div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="lp-stat-value">{{ $statistik['total_peminjaman_selesai'] }}</div>
                        <div class="lp-stat-label">Peminjaman Selesai</div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="lp-stat-value">3</div>
                        <div class="lp-stat-label">Peran Pengguna</div>
                    </div>
                </div>
            </div>
        </section>

        <section class="lp-section" id="fitur">
            <div class="container">
                <div class="text-center mb-5">
                    <span class="lp-eyebrow">Fitur Unggulan</span>
                    <h2 class="lp-section__title">Semua yang Dibutuhkan untuk Mengelola Peminjaman Alat</h2>
                    <p class="lp-section__desc mx-auto">Dirancang khusus untuk kebutuhan laboratorium dan ruang praktik sekolah.</p>
                </div>

                <div class="row g-4">
                    <div class="col-md-6 col-lg-4">
                        <div class="lp-fitur-card">
                            <div class="icon-tile bg-primary-subtle text-primary"><i class="bi bi-send-check"></i></div>
                            <h5>Pengajuan Daring</h5>
                            <p>Peminjam mengajukan peminjaman alat langsung dari katalog, tanpa formulir kertas.</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="lp-fitur-card">
                            <div class="icon-tile bg-info-subtle text-info"><i class="bi bi-clipboard-check"></i></div>
                            <h5>Persetujuan Bertingkat</h5>
                            <p>Petugas meninjau setiap pengajuan sebelum alat keluar, lengkap riwayat siapa yang memproses.</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="lp-fitur-card">
                            <div class="icon-tile bg-danger-subtle text-danger"><i class="bi bi-cash-coin"></i></div>
                            <h5>Denda Otomatis</h5>
                            <p>Keterlambatan dan kerusakan dihitung otomatis oleh sistem berdasarkan tarif yang berlaku.</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="lp-fitur-card">
                            <div class="icon-tile bg-warning-subtle text-warning"><i class="bi bi-bell"></i></div>
                            <h5>Notifikasi Jatuh Tempo</h5>
                            <p>Pengingat otomatis muncul di Navbar dan dasbor sebelum tenggat pengembalian terlewat.</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="lp-fitur-card">
                            <div class="icon-tile bg-success-subtle text-success"><i class="bi bi-star"></i></div>
                            <h5>Rating &amp; Ulasan Alat</h5>
                            <p>Peminjam bisa menilai kondisi dan performa alat setelah selesai memakainya.</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="lp-fitur-card">
                            <div class="icon-tile bg-secondary-subtle text-secondary"><i class="bi bi-file-earmark-bar-graph"></i></div>
                            <h5>Laporan Siap Cetak</h5>
                            <p>Laporan peminjaman, pengembalian, dan stok tersedia dalam format PDF kapan saja.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="lp-section lp-section--alt" id="cara-kerja">
            <div class="container">
                <div class="text-center mb-5">
                    <span class="lp-eyebrow">Cara Kerja</span>
                    <h2 class="lp-section__title">Empat Langkah Sederhana</h2>
                </div>

                <div class="row g-4">
                    <div class="col-md-6 col-lg-3">
                        <div class="lp-langkah">
                            <div class="lp-langkah__nomor">1</div>
                            <h6>Daftar Akun</h6>
                            <p>Isi formulir pendaftaran, tunggu verifikasi admin.</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="lp-langkah">
                            <div class="lp-langkah__nomor">2</div>
                            <h6>Ajukan Peminjaman</h6>
                            <p>Pilih alat dari katalog dan tuliskan keperluannya.</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="lp-langkah">
                            <div class="lp-langkah__nomor">3</div>
                            <h6>Ditinjau Petugas</h6>
                            <p>Petugas menyetujui, lalu alat siap diambil.</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="lp-langkah">
                            <div class="lp-langkah__nomor">4</div>
                            <h6>Kembalikan Tepat Waktu</h6>
                            <p>Verifikasi pengembalian, statistik pribadi ikut terupdate.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="lp-cta" id="tentang">
            <div class="container text-center">
                <h2 class="text-white fw-bold mb-3">Siap Digunakan untuk SMKN 1 Padaherang</h2>
                <p class="text-white-50 mb-4">
                    Dibangun untuk menggantikan pencatatan manual peminjaman alat praktik,
                    supaya lebih rapi, transparan, dan mudah ditelusuri.
                </p>
                <a href="{{ route('pendaftaran.form') }}" class="btn btn-light btn-lg px-4">
                    <i class="bi bi-person-plus me-1"></i>Mulai Sekarang
                </a>
            </div>
        </section>
    </main>

    <footer class="lp-footer">
    <div class="container d-flex flex-wrap justify-content-between align-items-center gap-2">
        <x-logo light />
        <p class="mb-0 small text-muted">&copy; {{ date('Y') }} SMKN 1 Padaherang. Sistem Peminjaman Alat.</p>
    </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>