@extends('layouts.utama')

@section('judul', 'Daftar Kategori')

@section('konten')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Daftar Kategori</h4>
        <x-tombol-tambah :href="route('kategori.create')" label="Tambah Kategori" />
    </div>

    <div class="card">
        <div class="card-body">

            <x-form-pencarian :action="route('kategori.index')" :kataKunci="$kataKunci" />

            <div class="table-responsive">
                <table class="table table-striped align-middle">
                    <thead>
                        <tr>
                            <th style="width: 60px">No</th>
                            <th>Nama</th>
                            <th>Deskripsi</th>
                            <th>Alat yang Memakai Kategori Ini</th>
                            <th style="width: 110px">Jumlah Alat</th>
                            <th style="width: 160px">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($daftarKategori as $nomor => $kategori)
                            <tr>
                                <td>{{ $daftarKategori->firstItem() + $nomor }}</td>
                                <td class="fw-semibold">{{ $kategori->nama }}</td>
                                <td>{{ $kategori->deskripsi ?: '-' }}</td>
                                <td>
                                    {{-- Memeriksa apakah relasi alat dimuat dan tidak kosong --}}
                                    @if($kategori->relationLoaded('daftarAlat') && $kategori->daftarAlat->isNotEmpty())
                                        <div class="d-flex flex-wrap gap-1">
                                            @foreach($kategori->daftarAlat as $alat)
                                                <span class="badge bg-secondary text-white" style="font-size: 0.8rem;">
                                                    {{ $alat->nama_alat ?? $alat->nama }}
                                                </span>
                                            @endforeach
                                        </div>
                                    @else
                                        <span class="text-muted fst-italic small">Tidak ada alat</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge bg-info text-dark">
                                        {{ $kategori->daftar_alat_count ?? $kategori->daftarAlat->count() }} Alat
                                    </span>
                                </td>
                                <td>
                                    <x-tombol-aksi 
                                        :ubah="route('kategori.edit', $kategori)"
                                        :hapus="route('kategori.destroy', $kategori)"
                                        pesanHapus="Yakin ingin menghapus kategori {{ $kategori->nama }}?"
                                    />
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted">
                                    Belum ada data kategori.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{ $daftarKategori->links() }}
            
        </div>
    </div>
@endsection