@extends('layouts.utama')
@section('judul', 'Beri Ulasan Alat')
@section('konten')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0">Beri Ulasan — {{ $detail->alat->nama }}</h4>
    <a href="{{ route('peminjaman.rincian', $detail->peminjaman_id) }}" class="btn btn-outline-secondary">Kembali</a>
</div>

<div class="card" style="max-width: 500px">
    <div class="card-body">
        <p class="text-muted small">
            Dipinjam pada {{ $detail->peminjaman->tgl_pinjam->format('d/m/Y') }},
            dari transaksi {{ $detail->peminjaman->kode_pinjam }}.
        </p>

        <form method="POST" action="{{ route('ulasan.simpan', $detail) }}">
            @csrf

            <div class="mb-3">
                <label class="form-label">Rating</label>
                <div class="btn-group" role="group">
                    @foreach ([1, 2, 3, 4, 5] as $bintang)
                        <input type="radio" class="btn-check" name="rating" id="rating{{ $bintang }}"
                            value="{{ $bintang }}" {{ old('rating') == $bintang ? 'checked' : '' }} required>
                        <label class="btn btn-outline-warning" for="rating{{ $bintang }}">{{ $bintang }} ★</label>
                    @endforeach
                </div>
                @error('rating')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="komentar" class="form-label">Komentar (opsional)</label>
                <textarea class="form-control" id="komentar" name="komentar" rows="3"
                    maxlength="500">{{ old('komentar') }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary w-100">Kirim Ulasan</button>
        </form>
    </div>
</div>
@endsection