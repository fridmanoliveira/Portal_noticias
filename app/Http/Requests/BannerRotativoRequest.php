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
        $imagemRule = $this->isMethod('post') ? 'required' : 'nullable';
        return [
            'imagem'     => "$imagemRule|image|mimes:jpg,jpeg,png|max:20480",
            'link' => 'nullable|url|max:255',
            'titulo' => 'required|string|max:255',
            'ordem' => 'required|integer',
            'ativo' => 'boolean',
        ];
    }
}
