<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PenolakanPendaftaranRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('user.kelola');
    }

    public function rules(): array
    {
        return [
            'alasan_penolakan' => ['required', 'string', 'max:500'],
        ];
    }

    public function messages(): array
    {
        return [
            'alasan_penolakan.required' => 'Alasan penolakan wajib diisi supaya pendaftar tahu apa yang perlu diperbaiki.',
        ];
    }
}