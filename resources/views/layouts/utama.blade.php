<!DOCTYPE html>
<html lang="id">
@include('layouts.head')
<body class="bg-app">

    @include('layouts.navbar')

    <div class="container py-4">
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/validasi-wajib.js') }}"></script>
    @stack('skrip')
</body>
</html>