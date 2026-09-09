@php
    $tujuanDasbor = match(true) {
        auth()->user()?->hasRole('admin')    => 'admin.dasbor',
        auth()->user()?->hasRole('petugas')  => 'petugas.dasbor',
        auth()->user()?->hasRole('peminjam') => 'peminjam.dasbor',
        default => null,
    };
@endphp

@if ($tujuanDasbor && ! request()->routeIs($tujuanDasbor))
    <a href="{{ route($tujuanDasbor) }}" class="btn-back">
        <i class="bi bi-arrow-left"></i> Kembali ke Dasbor
    </a>
@endif