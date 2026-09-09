@props(['light' => false])

<span class="d-inline-flex align-items-center gap-2">
    <span class="brand-mark {{ $light ? 'brand-mark--light' : '' }}">
        <i class="bi bi-boxes"></i>
    </span>
    <span class="brand-wordmark {{ $light ? 'brand-wordmark--dark' : '' }}">
        Peminjaman<span class="brand-wordmark__accent">Alat</span>
    </span>
</span>