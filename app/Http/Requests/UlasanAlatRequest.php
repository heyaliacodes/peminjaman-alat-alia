<?php

namespace App\Http\Requests;

use App\Models\UlasanAlat;
use Illuminate\Foundation\Http\FormRequest;

class UlasanAlatRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('create', [UlasanAlat::class, $this->route('detail')]);
    }

    public function rules(): array
    {
        return [
            'rating'   => ['required', 'integer', 'min:1', 'max:5'],
            'komentar' => ['nullable', 'string', 'max:500'],
        ];
    }
}