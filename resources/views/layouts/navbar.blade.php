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
                            </a>
                        </li>
                    @endcan
                    @can('alat.lihat')
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('peminjaman.saya') || request()->routeIs('peminjaman.rincian') ? 'active' : '' }}" href="{{ route('peminjaman.saya') }}">
                            <i class="bi bi-journal-text me-1"></i>Pinjaman Saya
                            @if (($notifikasiNavbar['jatuh_tempo_saya'] ?? 0) > 0)
                                <span class="badge bg-warning text-dark rounded-pill">{{ $notifikasiNavbar['jatuh_tempo_saya'] }}</span>
                            @endif
                        </a>
                    </li>
                    @endcan
                </ul>

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