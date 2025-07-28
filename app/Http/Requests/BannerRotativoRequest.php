<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BannerRotativoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'imagem' => 'nullable|image|max:20480',
            'link' => 'nullable|url|max:255',
            'titulo' => 'required|string|max:255',
            'ordem' => 'required|integer',
            'ativo' => 'boolean',
        ];
    }
}
