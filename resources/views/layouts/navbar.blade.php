<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/')}}">Peminjam Alat</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menuUtama">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="menuUtama">
            <ul class="navbar-nav me-auto">
                @can('kategori.kelola')
                    <li class="nav-item"><a class="nav-link" href="{{ route('kategori.index') }}">Kategori</a></li>
                @endcan
                @can('alat.kelola')
                    <li class="nav-item"><a class="nav-link" href="{{ route('alat.index') }}">Alat</a></li>
                @endcan
                @can('user.kelola')
                    <li class="nav-item"><a class="nav-link" href="{{ route('pengguna.index') }}">Pengguna</a></li>
                @endcan
                @can('peminjaman.setujui')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('persetujuan.antrian') }}">
                        Persetujuan
                            @if (($notifikasiNavbar['antrian_persetujuan'] ?? 0) > 0)
                                <span class="badge bg-danger rounded-pill">
                                    {{ $notifikasiNavbar['antrian_persetujuan'] }}
                                </span>
                            @endif
                        </a>
                    </li>
                @endcan
                @can('alat.lihat')
                    <li class="nav-item"><a class="nav-link" href="{{ route('katalog.daftar') }}">Katalog Alat</a></li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('katalog.keranjang') }}">
                            Keranjang
                            @if (count(session('keranjang', [])) > 0)
                                <span class="badge bg-warning text-dark">
                                    {{ count(session('keranjang', [])) }}
                                </span>
                            @endif
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('peminjaman.saya') }}">
                        Pinjaman Saya
                            @if (($notifikasiNavbar['jatuh_tempo_saya'] ?? 0) > 0)
                                <span class="badge bg-warning text-dark rounded-pill">
                                    {{ $notifikasiNavbar['jatuh_tempo_saya'] }}
                                </span>
                            @endif
                        </a>
                    </li>
                @endcan
                @can('pengembalian.pantau')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('pengembalian.pantau') }}">Pemantauan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('pengembalian.antrian') }}">
                        Verifikasi
                            @if (($notifikasiNavbar['antrian_verifikasi'] ?? 0) > 0)
                                <span class="badge bg-danger rounded-pill">
                                    {{ $notifikasiNavbar['antrian_verifikasi'] }}
                                </span>
                            @endif
                        </a>
                    </li>
                @endcan
                @can('log.lihat')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('log.index') }}">Log Aktivitas</a>
                    </li>
                @endcan
                @can('laporan.cetak')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('laporan.form') }}">Laporan</a>
                    </li>
                @endcan
                @can('peminjaman.kelola')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('koreksi.peminjaman.daftar') }}">Data Peminjaman</a>
                    </li>
                @endcan
                @can('pengembalian.kelola')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('koreksi.pengembalian.daftar') }}">Data Pengembalian</a>
                    </li>
                @endcan
                @can('pengaturan.kelola')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('pengaturan.form') }}">Pengaturan</a>
                    </li>
                @endcan
            </ul>
            @auth
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <span class="navbar-text me-3">{{ auth()->user()->nama }}</span>
                    </li>
                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-outline-light">Keluar</button>
                        </form>
                    </li>
                </ul>
            @endauth
        </div>
    </div>
</nav>