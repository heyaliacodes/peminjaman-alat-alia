<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AlatRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('alat.kelola');
    }

    public function rules(): array
    {
        $alatYangDiubah = $this->route('alat');

        return [
            'kategori_id' => ['required', 'exists:kategori,id'],
            'kode_alat' => [
                'required',
                'string',
                'max:30',
                Rule::unique('alat', 'kode_alat')->ignore($alatYangDiubah),
            ],
            'nama'      => ['required', 'string', 'max:150'],
            'deskripsi' => ['nullable', 'string', 'max:1000'],
            'stok' => [
                'required', 'integer', 'min:0',
                function ($attribute, $value, $fail) use ($alatYangDiubah) {
                    if (! $alatYangDiubah) {
                        return;
                    }

                    $jumlahDipinjam = $alatYangDiubah->stok - $alatYangDiubah->stok_tersedia;

                    if ($value < $jumlahDipinjam) {
                        $fail("Stok total tidak boleh kurang dari {$jumlahDipinjam} unit yang sedang dipinjam.");
                    }
                },
            ],
            'kondisi' => ['required', Rule::in(['baik', 'rusak_ringan', 'rusak_berat'])],
            'foto'    => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
        ];
    }

    public function messages(): array
    {
        return [
            'kategori_id.required' => 'Kategori wajib dipilih.',
            'kode_alat.unique'     => 'Kode alat tersebut sudah terdaftar.',
            'foto.max'             => 'Ukuran foto maksimal 2 MB.',
            'foto.mimes'           => 'Foto harus berformat JPG atau PNG.',
        ];
    }
}