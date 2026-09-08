<?php

namespace App\Http\Controllers;

use App\Http\Requests\UlasanAlatRequest;
use App\Models\DetailPeminjaman;
use App\Models\UlasanAlat;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class UlasanAlatController extends Controller
{
    use AuthorizesRequests;

    public function formBuat(DetailPeminjaman $detail)
    {
        $this->authorize('create', [UlasanAlat::class, $detail]);

        $detail->load(['alat', 'peminjaman']);

        return view('ulasan.form', compact('detail'));
    }

    public function simpan(UlasanAlatRequest $request, DetailPeminjaman $detail)
    {
        $data = $request->validated();

        UlasanAlat::create([
            'detail_peminjaman_id' => $detail->id,
            'alat_id'              => $detail->alat_id,
            'user_id'              => auth()->id(),
            'rating'               => $data['rating'],
            'komentar'             => $data['komentar'] ?? null,
        ]);

        return redirect()
            ->route('peminjaman.rincian', $detail->peminjaman_id)
            ->with('sukses', 'Terima kasih, ulasan Anda tersimpan.');
    }
}