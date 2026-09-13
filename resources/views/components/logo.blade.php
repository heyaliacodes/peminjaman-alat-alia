@props(['light' => false])

<span class="d-inline-flex align-items-center gap-2">
    <span class="brand-mark {{ $light ? 'brand-mark--light' : '' }}">
        <svg width="20" height="20" viewBox="0 0 36 36" xmlns="http://www.w3.org/2000/svg">
            <rect x="3" y="9" width="20" height="20" rx="6" fill="#818cf8"/>
            <rect x="13" y="3" width="20" height="20" rx="6" fill="#4f46e5"/>
        </svg>
    </span>
    <span class="brand-wordmark {{ $light ? 'brand-wordmark--dark' : '' }}">
        Peminjaman <span class="brand-wordmark__accent">Alat</span>
    </span>
</span>