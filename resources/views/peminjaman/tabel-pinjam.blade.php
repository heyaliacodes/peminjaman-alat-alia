<table class="table table-striped align-middle">
    <thead>
        <tr>
            <th>Kode Pinjam</th>
            <th>Tanggal Pinjam</th>
            <th>Harus Kembali</th>
            <th class="text-center">Jumlah Alat</th>
            <th>Status</th>
            <th style="width: 100px">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($daftarPeminjaman as $peminjaman)
            <tr>
                <td>{{ $peminjaman->kode_pinjam }}</td>
                <td>{{ $peminjaman->tgl_pinjam->format('d/m/Y') }}</td>
                <td>
                    {{ $peminjaman->tgl_harus_kembali->format('d/m/Y') }}
                        @if ($peminjaman->lewatTenggat())
                            <span class="badge bg-danger">
                                Terlambat {{ $peminjaman->tgl_harus_kembali->diffInDays(now()) }} hari
                            </span>
                        @elseif ($peminjaman->jatuhTempoBesok())
                            <span class="badge bg-warning text-dark">Jatuh tempo besok</span>
                        @endif
                </td>
                <td class="text-center">{{ $peminjaman->detail->count() }}</td>
                <td>
                    <span class="badge bg-{{ $peminjaman->status->warna() }}">
                        {{ $peminjaman->status->label() }}
                    </span>
                </td>
                <td>
                    <a href="{{ route('peminjaman.rincian', $peminjaman) }}"
                        class="btn btn-sm btn-outline-primary">Rincian</a>

                    @if ($peminjaman->status === \App\Enums\StatusPeminjaman::Dipinjam)
                        <form
                        method="POST" action="{{ route('pengembalian.ajukan', $peminjaman) }}"
                        class="d-inline"
                        onsubmit="return confirm('Ajukan pengembalian seluruh alat?')">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-success">Kembalikan</button>
                        </form>
                    @endif
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6" class="text-center text-muted">
                    Belum ada pengajuan peminjaman.
                </td>
            </tr>
        @endforelse
    </tbody>
</table>
