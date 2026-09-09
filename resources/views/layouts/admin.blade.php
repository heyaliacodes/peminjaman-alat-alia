<!DOCTYPE html>
<html lang="id">
@include('layouts.head')
<body class="bg-app admin-shell">

    <aside class="admin-sidebar" id="adminSidebar">
        <div class="admin-sidebar__brand">
            <a href="{{ route('admin.dasbor') }}" class="text-decoration-none">
                <x-logo light />
            </a>
        </div>

        <nav class="admin-sidebar__nav">
            @canany(['kategori.kelola', 'alat.kelola', 'user.kelola'])
                <div class="admin-sidebar__section">Master Data</div>
                @can('kategori.kelola')
                    <a class="admin-sidebar__link {{ request()->routeIs('kategori.*') ? 'active' : '' }}" href="{{ route('kategori.index') }}">
                        <i class="bi bi-tags"></i> Kategori
                    </a>
                @endcan
                @can('alat.kelola')
                    <a class="admin-sidebar__link {{ request()->routeIs('alat.*') ? 'active' : '' }}" href="{{ route('alat.index') }}">
                        <i class="bi bi-box-seam"></i> Alat
                    </a>
                @endcan
                @can('user.kelola')
                    <a class="admin-sidebar__link {{ request()->routeIs('pengguna.*') ? 'active' : '' }}" href="{{ route('pengguna.index') }}">
                        <i class="bi bi-people"></i> Pengguna
                    </a>
                @endcan
            @endcanany

            @canany(['peminjaman.kelola', 'pengembalian.kelola', 'log.lihat'])
                <div class="admin-sidebar__section">Data &amp; Log</div>
                @can('peminjaman.kelola')
                    <a class="admin-sidebar__link {{ request()->routeIs('koreksi.peminjaman.*') ? 'active' : '' }}" href="{{ route('koreksi.peminjaman.daftar') }}">
                        <i class="bi bi-pencil-square"></i> Data Peminjaman
                    </a>
                @endcan
                @can('pengembalian.kelola')
                    <a class="admin-sidebar__link {{ request()->routeIs('koreksi.pengembalian.*') ? 'active' : '' }}" href="{{ route('koreksi.pengembalian.daftar') }}">
                        <i class="bi bi-pencil-square"></i> Data Pengembalian
                    </a>
                @endcan
                @can('log.lihat')
                    <a class="admin-sidebar__link {{ request()->routeIs('log.*') ? 'active' : '' }}" href="{{ route('log.index') }}">
                        <i class="bi bi-journal-code"></i> Log Aktivitas
                    </a>
                @endcan
            @endcanany

            @can('pengaturan.kelola')
                <div class="admin-sidebar__section">Sistem</div>
                <a class="admin-sidebar__link {{ request()->routeIs('pengaturan.*') ? 'active' : '' }}" href="{{ route('pengaturan.form') }}">
                    <i class="bi bi-gear"></i> Pengaturan
                </a>
            @endcan
        </nav>

        <div class="admin-sidebar__user">
            <span class="avatar-circle avatar-circle--dark">{{ strtoupper(mb_substr(auth()->user()->nama, 0, 1)) }}</span>
            <div class="flex-grow-1 overflow-hidden">
                <div class="small fw-semibold text-truncate">{{ auth()->user()->nama }}</div>
                <div class="small text-muted">Administrator</div>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn-icon-plain" title="Keluar">
                    <i class="bi bi-box-arrow-right"></i>
                </button>
            </form>
        </div>
    </aside>

    <button class="admin-sidebar__toggle d-lg-none" type="button" id="tombolSidebar">
        <i class="bi bi-list"></i>
    </button>

    <main class="admin-content">
        <div class="container-fluid py-4 px-3 px-lg-4">
            <x-tombol-kembali />

            @if (session('sukses'))
                <div class="alert alert-success d-flex align-items-center gap-2 shadow-sm border-0" role="alert">
                    <i class="bi bi-check-circle-fill fs-5"></i>
                    <div>{{ session('sukses') }}</div>
                </div>
            @endif

            @if (session('gagal'))
                <div class="alert alert-danger d-flex align-items-center gap-2 shadow-sm border-0" role="alert">
                    <i class="bi bi-exclamation-triangle-fill fs-5"></i>
                    <div>{{ session('gagal') }}</div>
                </div>
            @endif

            @yield('konten')
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/validasi-wajib.js') }}"></script>
    <script>
        document.getElementById('tombolSidebar')?.addEventListener('click', function () {
            document.getElementById('adminSidebar').classList.toggle('is-open');
        });
    </script>
    @stack('skrip')
</body>
</html>