@extends('layouts.utama')

@section('judul', $alat->exists ? 'Ubah Alat' : 'Tambah Alat')

@section('konten')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-body p-4">
                    <h5 class="card-title fw-bold mb-4">
                        {{ $alat->exists ? 'Ubah Data Alat' : 'Tambah Data Alat' }}
                    </h5>

                    <form method="POST" action="{{ $alat->exists ? route('alat.update', $alat) : route('alat.store') }}"
                        enctype="multipart/form-data">
                        @csrf
                        @if ($alat->exists)
                            @method('PUT')
                        @endif

                        <div class="row">
                            <div class="col-md-4">
                                <x-input name="kode_alat" label="Kode Alat" :value="$alat->kode_alat" required />
                            </div>

                            <div class="col-md-8">
                                <x-input name="nama" label="Nama Alat" :value="$alat->nama" required />
                            </div>
                        </div>

                        <x-select name="kategori_id" label="Kategori" :opsi="$daftarKategori" :value="$alat->kategori_id" keyValue="id"
                            keyLabel="nama" placeholder="Pilih kategori" required />

                        <div class="row">
                            <div class="col-md-6">
                                <x-input name="stok" label="Stok Total" :value="$alat->stok" type="number" min="0" required />
                            </div>

                            <div class="col-md-6">
                                {{-- PERBAIKAN: ganti nama="" menjadi name="" & tambahkan keyValue/keyLabel --}}
                                <x-select name="kondisi" label="Kondisi" :opsi="[
                                    ['key' => 'baik', 'label' => 'Baik'],
                                    ['key' => 'rusak_ringan', 'label' => 'Rusak Ringan'],
                                    ['key' => 'rusak_berat', 'label' => 'Rusak Berat'],
                                ]" :value="$alat->kondisi" keyValue="key" keyLabel="label" placeholder="Pilih kondisi" required />
                            </div>
                        </div>

                        @if ($alat->exists)
                            @php
                                $jumlahDipinjam = $alat->stok - $alat->stok_tersedia;
                            @endphp
                            <div class="alert alert-info small d-flex align-items-start gap-2 mb-3">
                                <i class="bi bi-info-circle fs-6 mt-1"></i>
                                <div>
                                    <strong>{{ $jumlahDipinjam }}</strong> dari {{ $alat->stok }} unit sedang dipinjam saat ini.
                                    "Stok Total" boleh disesuaikan (menambah unit baru atau menghapus unit yang rusak permanen),
                                    tapi tidak boleh diturunkan sampai di bawah jumlah yang sedang dipinjam.
                                </div>
                            </div>
                        @endif

                        <x-textarea name="deskripsi" label="Deskripsi" rows="3" :value="$alat->deskripsi" />

                        @include('alat.input-foto')

                        <div class="d-flex gap-2 mt-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save me-1"></i>Simpan
                            </button>
                            <a href="{{ route('alat.index') }}" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection