@extends('layouts.admin')

@section('judul', 'Verifikasi Pendaftaran')

@section('konten')
    <div class="mb-4">
        <h4 class="fw-bold mb-1">Verifikasi Pendaftaran Akun</h4>
        <p class="text-muted mb-0">Tinjau data peminjam baru sebelum akunnya bisa dipakai untuk masuk.</p>
    </div>

    <ul class="nav nav-pills mb-3">
        <li class="nav-item">
            <a class="nav-link {{ $status === 'menunggu' ? 'active' : '' }}" href="{{ route('pendaftaran.admin.daftar', ['status' => 'menunggu']) }}">Menunggu</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ $status === 'diterima' ? 'active' : '' }}" href="{{ route('pendaftaran.admin.daftar', ['status' => 'diterima']) }}">Diterima</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ $status === 'ditolak' ? 'active' : '' }}" href="{{ route('pendaftaran.admin.daftar', ['status' => 'ditolak']) }}">Ditolak</a>
        </li>
    </ul>

    <div class="card border-0 shadow-sm">
        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Kode</th>
                        <th>Nama</th>
                        <th>Nama Pengguna</th>
                        <th>Kontak</th>
                        <th>Tanggal Daftar</th>
                        @if ($status !== 'menunggu')
                            <th>Diproses Oleh</th>
                        @endif
                        @if ($status === 'menunggu')
                            <th class="text-end">Aksi</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @forelse ($daftarPendaftaran as $pendaftaran)
                        <tr>
                            <td><code>{{ $pendaftaran->kode_pendaftaran }}</code></td>
                            <td>{{ $pendaftaran->nama }}</td>
                            <td>{{ $pendaftaran->username }}</td>
                            <td>
                                {{ $pendaftaran->email ?? '-' }}<br>
                                <span class="text-muted small">{{ $pendaftaran->no_telp ?? '-' }}</span>
                            </td>
                            <td>{{ $pendaftaran->created_at->format('d/m/Y H:i') }}</td>
                            @if ($status !== 'menunggu')
                                <td>{{ $pendaftaran->diprosesOleh?->nama ?? '-' }}</td>
                            @endif
                            @if ($status === 'menunggu')
                                <td class="text-end">
                                    <form method="POST" action="{{ route('pendaftaran.admin.terima', $pendaftaran) }}" class="d-inline"
                                        onsubmit="return confirm('Terima pendaftaran {{ $pendaftaran->nama }}?');">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-success">
                                            <i class="bi bi-check-lg"></i> Terima
                                        </button>
                                    </form>
                                    <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modalTolak{{ $pendaftaran->id }}">
                                        <i class="bi bi-x-lg"></i> Tolak
                                    </button>
                                </td>
                            @endif
                        </tr>
                    @empty
                        <tr>
                            <td colspan="{{ $status === 'menunggu' ? 6 : 6 }}" class="text-center text-muted py-4">Tidak ada data pada status ini.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- KODE MODAL DIPINDAHKAN KE LUAR TABEL AGAR STRUKTUR HTML SAH --}}
    @if ($status === 'menunggu')
        @foreach ($daftarPendaftaran as $pendaftaran)
            <div class="modal fade" id="modalTolak{{ $pendaftaran->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <form method="POST" action="{{ route('pendaftaran.admin.tolak', $pendaftaran) }}" class="modal-content">
                        @csrf
                        <div class="modal-header">
                            <h6 class="modal-title">Tolak Pendaftaran {{ $pendaftaran->nama }}</h6>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <label class="form-label">Alasan Penolakan <span class="text-danger">*</span></label>
                            <textarea name="alasan_penolakan" class="form-control" rows="3" required
                                placeholder="Contoh: data tidak sesuai kartu pelajar"></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-danger">Tolak Pendaftaran</button>
                        </div>
                    </form>
                </div>
            </div>
        @endforeach
    @endif

    <div class="mt-3">
        {{ $daftarPendaftaran->links() }}
    </div>
@endsection