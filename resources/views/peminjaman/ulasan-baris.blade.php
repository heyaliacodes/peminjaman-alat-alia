@if ($peminjaman->status === \App\Enums\StatusPeminjaman::Selesai)
    @if ($baris->ulasan)
        <div class="small">
            <span class="text-warning">
                @for ($i = 1; $i <= 5; $i++)
                    {{ $i <= $baris->ulasan->rating ? '★' : '☆' }}
                @endfor
            </span>
            @if ($baris->ulasan->komentar)
                <div class="text-muted fst-italic">"{{ $baris->ulasan->komentar }}"</div>
            @endif
        </div>
    @else
        <a href="{{ route('ulasan.buat', $baris) }}" class="btn btn-sm btn-outline-warning">
            Beri Ulasan
        </a>
    @endif
@endif