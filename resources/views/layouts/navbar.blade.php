<nav class="navbar navbar-expand-lg navbar-dark navbar-modern sticky-top shadow-sm">
    <div class="container-fluid px-3 px-lg-4">
        <a class="navbar-brand" href="{{ url('/') }}">
            <x-logo />
        </a>

        @auth
            <div class="d-flex align-items-center order-lg-3 gap-2">
                @php
                    $totalNotifikasi = ($notifikasiNavbar['antrian_persetujuan'] ?? 0)
                        + ($notifikasiNavbar['antrian_verifikasi'] ?? 0)
                        + ($notifikasiNavbar['terlambat_saya'] ?? 0)
                        + ($notifikasiNavbar['jatuh_tempo_dekat_saya'] ?? 0)
                        + ($notifikasiNavbar['disetujui_saya'] ?? 0)
                        + ($notifikasiNavbar['ditolak_saya'] ?? 0);
                @endphp

                <!-- Dropdown Notifikasi -->
                <div class="dropdown">
                    <a class="nav-link notif-bell position-relative" href="#" role="button" data-bs-toggle="dropdown">
                        <i class="bi bi-bell fs-5"></i>
                        @if ($totalNotifikasi > 0)
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 0.65rem;">
                                {{ $totalNotifikasi > 99 ? '99+' : $totalNotifikasi }}
                                <span class="visually-hidden">notifikasi belum dibaca</span>
                            </span>
                        @endif
                    </a>
                    <div class="dropdown-menu dropdown-menu-end notif-dropdown">
                        <h6 class="dropdown-header">Notifikasi</h6>

                        {{-- NOTIFIKASI PETUGAS / ADMIN --}}
                        @can('peminjaman.setujui')
                            @if (($notifikasiNavbar['antrian_persetujuan'] ?? 0) > 0)
                                <a href="{{ route('persetujuan.antrian') }}" class="notif-item text-decoration-none">
                                    <span class="notif-item__icon bg-warning-subtle text-warning"><i class="bi bi-clipboard-check"></i></span>
                                    <span>
                                        <strong class="d-block text-dark">{{ $notifikasiNavbar['antrian_persetujuan'] }} pengajuan menunggu</strong>
                                        <span class="small text-muted">Perlu persetujuan Anda</span>
                                    </span>
                                </a>
                            @endif
                        @endcan

                        @can('pengembalian.pantau')
                            @if (($notifikasiNavbar['antrian_verifikasi'] ?? 0) > 0)
                                <a href="{{ route('pengembalian.antrian') }}" class="notif-item text-decoration-none">
                                    <span class="notif-item__icon bg-danger-subtle text-danger"><i class="bi bi-arrow-return-left"></i></span>
                                    <span>
                                        <strong class="d-block text-dark">{{ $notifikasiNavbar['antrian_verifikasi'] }} pengembalian menunggu</strong>
                                        <span class="small text-muted">Perlu diverifikasi</span>
                                    </span>
                                </a>
                            @endif
                        @endcan

                        {{-- NOTIFIKASI PEMINJAM --}}
                        @if (($notifikasiNavbar['disetujui_saya'] ?? 0) > 0)
                            <a href="{{ route('peminjaman.saya') }}" class="notif-item text-decoration-none">
                                <span class="notif-item__icon bg-success-subtle text-success"><i class="bi bi-check-circle"></i></span>
                                <span>
                                    <strong class="d-block text-dark">{{ $notifikasiNavbar['disetujui_saya'] }} pengajuan disetujui</strong>
                                    <span class="small text-muted">Siap diambil di ruang petugas</span>
                                </span>
                            </a>
                        @endif

                        @if (($notifikasiNavbar['ditolak_saya'] ?? 0) > 0)
                            <a href="{{ route('peminjaman.saya') }}" class="notif-item text-decoration-none">
                                <span class="notif-item__icon bg-danger-subtle text-danger"><i class="bi bi-x-circle"></i></span>
                                <span>
                                    <strong class="d-block text-dark">{{ $notifikasiNavbar['ditolak_saya'] }} pengajuan ditolak</strong>
                                    <span class="small text-muted">Lihat alasan penolakan</span>
                                </span>
                            </a>
                        @endif

                        {{-- NOTIFIKASI TERLAMBAT (SUDAH LEWAT TENGGAT) --}}
                        @if (($notifikasiNavbar['terlambat_saya'] ?? 0) > 0)
                            <a href="{{ route('peminjaman.saya') }}" class="notif-item text-decoration-none">
                                <span class="notif-item__icon bg-danger-subtle text-danger"><i class="bi bi-exclamation-octagon"></i></span>
                                <span>
                                    <strong class="d-block text-danger">{{ $notifikasiNavbar['terlambat_saya'] }} peminjaman terlambat</strong>
                                    <span class="small text-muted">Sudah melewati batas pengembalian</span>
                                </span>
                            </a>
                        @endif

                        {{-- NOTIFIKASI JATUH TEMPO DEKAT (HARI INI / BESOK) --}}
                        @if (($notifikasiNavbar['jatuh_tempo_dekat_saya'] ?? 0) > 0)
                            <a href="{{ route('peminjaman.saya') }}" class="notif-item text-decoration-none">
                                <span class="notif-item__icon bg-warning-subtle text-warning"><i class="bi bi-exclamation-triangle"></i></span>
                                <span>
                                    <strong class="d-block text-dark">{{ $notifikasiNavbar['jatuh_tempo_dekat_saya'] }} peminjaman jatuh tempo</strong>
                                    <span class="small text-muted">Segera dikembalikan</span>
                                </span>
                            </a>
                        @endif

                        @if ($totalNotifikasi === 0)
                            <div class="text-center text-muted small py-3">Tidak ada notifikasi baru.</div>
                        @endif
                    </div>
                </div>

                <!-- Dropdown Profil User -->
                <div class="dropdown">
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
                </div>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menuUtama">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>

            <!-- Menu Navbar Utama -->
            <div class="collapse navbar-collapse order-lg-2" id="menuUtama">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 align-items-lg-center">

                    @can('peminjaman.setujui')
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('persetujuan.*') ? 'active' : '' }}" href="{{ route('persetujuan.antrian') }}">
                                <i class="bi bi-clipboard-check me-1"></i>Persetujuan
                                @if (($notifikasiNavbar['antrian_persetujuan'] ?? 0) > 0)
                                    <span class="badge bg-danger rounded-pill">{{ $notifikasiNavbar['antrian_persetujuan'] }}</span>
                                @endif
                            </a>
                        </li>
                    @endcan

                    @can('pengembalian.pantau')
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('pengembalian.pantau') ? 'active' : '' }}" href="{{ route('pengembalian.pantau') }}">
                                <i class="bi bi-eye me-1"></i>Pemantauan
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('pengembalian.antrian') || request()->routeIs('pengembalian.rincian') ? 'active' : '' }}" href="{{ route('pengembalian.antrian') }}">
                                <i class="bi bi-arrow-return-left me-1"></i>Verifikasi
                                @if (($notifikasiNavbar['antrian_verifikasi'] ?? 0) > 0)
                                    <span class="badge bg-danger rounded-pill">{{ $notifikasiNavbar['antrian_verifikasi'] }}</span>
                                @endif
                            </a>
                        </li>
                    @endcan

                    @can('laporan.cetak')
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('laporan.*') ? 'active' : '' }}" href="{{ route('laporan.form') }}">
                                <i class="bi bi-file-earmark-bar-graph me-1"></i>Laporan
                            </a>
                        </li>
                    @endcan

                    @can('alat.lihat')
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('katalog.daftar') ? 'active' : '' }}" href="{{ route('katalog.daftar') }}">
                                <i class="bi bi-grid me-1"></i>Katalog Alat
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('katalog.keranjang') ? 'active' : '' }}" href="{{ route('katalog.keranjang') }}">
                                <i class="bi bi-cart3 me-1"></i>Keranjang
                                @if (count(session('keranjang', [])) > 0)
                                    <span class="badge bg-warning text-dark">
                                        {{ count(session('keranjang', [])) }}
                                    </span>
                                @endif
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('peminjaman.saya') || request()->routeIs('peminjaman.rincian') ? 'active' : '' }}" href="{{ route('peminjaman.saya') }}">
                                <i class="bi bi-journal-text me-1"></i>Pinjaman Saya
                                @php
                                    $notifPeminjamMenu = ($notifikasiNavbar['terlambat_saya'] ?? 0)
                                        + ($notifikasiNavbar['jatuh_tempo_dekat_saya'] ?? 0)
                                        + ($notifikasiNavbar['disetujui_saya'] ?? 0)
                                        + ($notifikasiNavbar['ditolak_saya'] ?? 0);
                                @endphp
                                @if ($notifPeminjamMenu > 0)
                                    <span class="badge bg-warning text-dark rounded-pill">{{ $notifPeminjamMenu }}</span>
                                @endif
                            </a>
                        </li>
                    @endcan
                </ul>
            </div>
        @endauth
    </div>
</nav>