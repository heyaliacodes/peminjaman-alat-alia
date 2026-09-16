<table class="table table-striped align-middle">
    <thead>
        <tr>
            <th>Kode Pinjam</th>
            <th>Peminjam</th>
            <th>Harus Kembali</th>
            <th class="text-center">Jumlah & Daftar Alat</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($daftarPeminjaman as $peminjaman)
            <tr class="{{ $peminjaman->lewatTenggat() ? 'table-warning' : '' }}">
                <td>
                    {{-- Jika ada route rincian, bisa dibungkus <a> agar bisa diklik --}}
                    <span class="fw-bold text-dark">{{ $peminjaman->kode_pinjam }}</span>
                </td>
                <td>{{ $peminjaman->peminjam->nama }}</td>
                <td>
                    {{ $peminjaman->tgl_harus_kembali->format('d/m/Y') }}
                    @if ($peminjaman->lewatTenggat())
                        <span class="badge bg-danger ms-1">
                            Terlambat {{ (int) $peminjaman->tgl_harus_kembali->diffInDays(now()) }} hari
                        </span>
                    @endif
                </td>
                <td>
                    {{-- Tampilkan jumlah total alat di atas --}}
                    <div class="text-center fw-semibold mb-1">
                        <span class="badge bg-secondary">{{ $peminjaman->detail->count() }} Jenis Alat</span>
                    </div>
                    
                    {{-- Tampilkan rincian nama alat secara ringkas di bawahnya --}}
                    <div class="small text-muted ps-2" style="line-height: 1.3;">
                        @foreach ($peminjaman->detail as $detail)
                            <div>• {{ $detail->alat->nama ?? 'Alat' }} 
                                <span class="badge bg-light text-dark border">x{{ $detail->jumlah }}</span>
                            </div>
                        @endforeach
                    </div>
                </td>
                <td>
                    <span class="badge bg-{{ $peminjaman->status->warna() }}">
                        {{ $peminjaman->status->label() }}
                    </span>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="text-center text-muted py-4">
                    Tidak ada peminjaman yang sedang berjalan.
                </td>
            </tr>
        @endforelse
    </tbody>
</table>