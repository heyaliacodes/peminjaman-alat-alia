<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('judul', 'Peminjaman Alat')</title>

    <link rel="icon" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24'%3E%3Crect width='24' height='24' rx='6' fill='%234f46e5'/%3E%3Cpath d='M6 9l6-3 6 3-6 3-6-3zm0 3l6 3 6-3M6 15l6 3 6-3' stroke='white' stroke-width='1.5' fill='none' stroke-linejoin='round'/%3E%3C/svg%3E">

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="{{ asset('css/kustom.css') }}" rel="stylesheet">
</head>

<body class="bg-app">

    @include('layouts.navbar')

    <div class="container py-4">
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('skrip')
</body>
</html>