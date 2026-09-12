<?php

namespace App\Http\Requests;

use App\Enums\StatusPendaftaran;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PendaftaranRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nama' => ['required', 'string', 'max:100'],
            'username' => [
                'required', 'string', 'max:50', 'alpha_dash',
                Rule::unique('users', 'username'),
                Rule::unique('pendaftaran_akun', 'username')
                    ->where(fn ($query) => $query->where('status', StatusPendaftaran::Menunggu)),
            ],
            'email' => [
                'nullable', 'email', 'max:100',
                Rule::unique('users', 'email'),
                Rule::unique('pendaftaran_akun', 'email')
                    ->where(fn ($query) => $query->where('status', StatusPendaftaran::Menunggu)),
            ],
            'no_telp'  => ['nullable', 'string', 'max:20'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];
    }

    public function messages(): array
    {
        return [
            'username.unique'     => 'Nama pengguna tersebut sudah dipakai atau sedang menunggu verifikasi.',
            'username.alpha_dash' => 'Nama pengguna hanya boleh berisi huruf, angka, garis bawah, dan tanda hubung.',
            'email.unique'        => 'Email tersebut sudah dipakai atau sedang menunggu verifikasi.',
            'password.confirmed'  => 'Konfirmasi kata sandi tidak cocok.',
            'password.min'        => 'Kata sandi minimal 8 karakter.',
        ];
    }
}