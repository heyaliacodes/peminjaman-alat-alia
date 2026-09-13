@props(['light' => false])

@php $idGradien = 'brandLogoGradient' . uniqid(); @endphp

<span class="d-inline-flex align-items-center gap-2">
    <svg class="brand-logo__mark" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
        <rect width="40" height="40" rx="11" fill="url(#{{ $idGradien }})"/>
        <path d="M12 15.5L20 11L28 15.5V25.5L20 30L12 25.5V15.5Z" stroke="white" stroke-width="2" stroke-linejoin="round"/>
        <path d="M12 15.5L20 20L28 15.5" stroke="white" stroke-width="2" stroke-linejoin="round"/>
        <path d="M20 20V30" stroke="white" stroke-width="2"/>
        <defs>
            <linearGradient id="{{ $idGradien }}" x1="0" y1="0" x2="40" y2="40" gradientUnits="userSpaceOnUse">
                <stop stop-color="#818cf8"/>
                <stop offset="1" stop-color="#4338ca"/>
            </linearGradient>
        </defs>
    </svg>
    <span class="brand-wordmark {{ $light ? 'brand-wordmark--dark' : '' }}">
        Peminjaman<span class="brand-wordmark__accent">Alat</span>
    </span>
</span>