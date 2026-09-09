<nav class="navbar navbar-expand-lg navbar-dark navbar-modern sticky-top shadow-sm">
    <div class="container-fluid px-3 px-lg-4">
        <a class="navbar-brand" href="{{ url('/') }}">
            <x-logo />
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menuUtama">
            <span class="navbar-toggler-icon"></span>
        </button>

        @auth
            <div class="collapse navbar-collapse" id="menuUtama">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 align-items-lg-center">

                    {{-- Admin: master data --}}
                    @canany(['kategori.kelola', 'alat.kelola', 'user.kelola'])
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                <i class="bi bi-database-gear me-1"></i>Master Data
                            </a>
                            <ul class="dropdown-menu">
                                @can('kategori.kelola')
                                    <li><a class="dropdown-item" href="{{ route('kategori.index') }}"><i class="bi bi-tags me-2"></i>Kategori</a></li>
                                @endcan
                                @can('alat.kelola')
                                    <li><a class="dropdown-item" href="{{ route('alat.index') }}"><i class="bi bi-box-seam me-2"></i>Alat</a></li>
                                @endcan
                                @can('user.kelola')
                                    <li><a class="dropdown-item" href="{{ route('pengguna.index') }}"><i class="bi bi-people me-2"></i>Pengguna</a></li>
                                @endcan
                            </ul>
                        </li>
                    @endcanany

                    {{-- Admin: koreksi data & log --}}
                    @canany(['peminjaman.kelola', 'pengembalian.kelola', 'log.lihat'])
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                <i class="bi bi-clock-history me-1"></i>Data &amp; Log
                            </a>
                            <ul class="dropdown-menu">
                                @can('peminjaman.kelola')
                                    <li><a class="dropdown-item" href="{{ route('koreksi.peminjaman.daftar') }}"><i class="bi bi-pencil-square me-2"></i>Data Peminjaman</a></li>
                                @endcan
                                @can('pengembalian.kelola')
                                    <li><a class="dropdown-item" href="{{ route('koreksi.pengembalian.daftar') }}"><i class="bi bi-pencil-square me-2"></i>Data Pengembalian</a></li>
                                @endcan
                                @can('log.lihat')
                                    <li><a class="dropdown-item" href="{{ route('log.index') }}"><i class="bi bi-journal-code me-2"></i>Log Aktivitas</a></li>
                                @endcan
                            </ul>
                        </li>
                    @endcanany

                    @can('pengaturan.kelola')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('pengaturan.form') }}"><i class="bi bi-gear me-1"></i>Pengaturan</a>
                        </li>
                    @endcan

                    {{-- Petugas --}}
                    @can('peminjaman.setujui')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('persetujuan.antrian') }}">
                                <i class="bi bi-clipboard-check me-1"></i>Persetujuan
                                @if (($notifikasiNavbar['antrian_persetujuan'] ?? 0) > 0)
                                    <span class="badge bg-danger rounded-pill">{{ $notifikasiNavbar['antrian_persetujuan'] }}</span>
                                @endif
                            </a>
                        </li>
                    @endcan

                    @can('pengembalian.pantau')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('pengembalian.pantau') }}">
                                <i class="bi bi-eye me-1"></i>Pemantauan
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('pengembalian.antrian') }}">
                                <i class="bi bi-arrow-return-left me-1"></i>Verifikasi
                                @if (($notifikasiNavbar['antrian_verifikasi'] ?? 0) > 0)
                                    <span class="badge bg-danger rounded-pill">{{ $notifikasiNavbar['antrian_verifikasi'] }}</span>
                                @endif
                            </a>
                        </li>
                    @endcan

                    @can('laporan.cetak')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('laporan.form') }}"><i class="bi bi-file-earmark-bar-graph me-1"></i>Laporan</a>
                        </li>
                    @endcan

                    {{-- Peminjam --}}
                    @can('alat.lihat')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('katalog.daftar') }}"><i class="bi bi-grid me-1"></i>Katalog Alat</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('katalog.keranjang') }}"><i class="bi bi-cart3 me-1"></i>Keranjang</a>
                        </li>
                    @endcan
                    @can('alat.lihat')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('peminjaman.saya') }}">
                            <i class="bi bi-journal-text me-1"></i>Pinjaman Saya
                            @if (($notifikasiNavbar['jatuh_tempo_saya'] ?? 0) > 0)
                                <span class="badge bg-warning text-dark rounded-pill">{{ $notifikasiNavbar['jatuh_tempo_saya'] }}</span>
                            @endif
                        </a>
                    </li>
                </ul>
                @endcan
                
                <ul class="navbar-nav align-items-lg-center">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center gap-2" href="#" role="button" data-bs-toggle="dropdown">
                            <span class="avatar-circle">{{ strtoupper(mb_substr(auth()->user()->nama, 0, 1)) }}</span>
                            <span class="d-none d-xl-inline">{{ auth()->user()->nama }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li class="dropdown-item-text small text-muted">
                                Masuk sebagai<br><strong>{{ auth()->user()->nama }}</strong>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">
                                        <i class="bi bi-box-arrow-right me-2"></i>Keluar
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        @endauth
    </div>
</nav>