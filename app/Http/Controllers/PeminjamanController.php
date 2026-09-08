<?php

namespace App\Http\Controllers;

use App\Http\Requests\PengajuanRequest;
use App\Models\Peminjaman;
use App\Services\Keranjang;
use App\Services\PeminjamanService;
use Illuminate\Validation\ValidationException;
use App\Services\StatistikPeminjamService;
use App\Services\NotifikasiNavbarService;

class PeminjamanController extends Controller
{
    public function __construct(
        private PeminjamanService $layanan,
        private StatistikPeminjamService $layananStatistik,
        private NotifikasiNavbarService $layananNotifikasi,
        private Keranjang $keranjang
    ) {
    }

    public function formPengajuan()
    {
        if ($this->keranjang->kosong()) {
            return redirect()
                ->route('katalog.daftar')
                ->with('gagal', 'Pilih alat terlebih dahulu sebelum mengajukan.');
        }

        $isiKeranjang    = $this->keranjang->isi();
        $daftarTunggakan = $this->layanan->daftarTunggakan(auth()->user());
        $defaultHari     = $this->layanan->defaultHariPinjam();
        $maksHari        = $this->layanan->maksHariPinjam();

        return view('peminjaman.form', compact(
            'isiKeranjang', 'daftarTunggakan', 'defaultHari', 'maksHari'
        ));
    }

    public function simpanPengajuan(PengajuanRequest $request)
    {
        try {
            $peminjaman = $this->layanan->buatPengajuan(
                auth()->user(),
                $request->validated()
            );
        } catch (ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        }

        return redirect()
            ->route('peminjaman.saya')
            ->with('sukses', 'Pengajuan ' . $peminjaman->kode_pinjam . ' berhasil dikirim.');
    }

    public function daftarSaya()
    {
        $daftarPeminjaman = Peminjaman::with(['detail.alat'])
            ->where('user_id', auth()->id())
            ->orderByDesc('created_at')
            ->paginate(10);
        $statistik = $this->layananStatistik->ringkasan(auth()->user());

        $statistik = $this->layananStatistik->ringkasan(auth()->user());

            $jumlahJatuhTempo = $this->layananNotifikasi
                ->untukPengguna(auth()->user())['jatuh_tempo_saya'];

        return view('peminjaman.saya', compact('daftarPeminjaman', 'statistik', 'jumlahJatuhTempo'));


    }

    public function rincian(Peminjaman $peminjaman)
    {
        abort_unless($peminjaman->user_id === auth()->id(), 403);

        $peminjaman->load(['detail.alat', 'petugas']);

        return view('peminjaman.rincian', compact('peminjaman'));
    }
}

