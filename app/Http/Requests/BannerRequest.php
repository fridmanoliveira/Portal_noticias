<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BannerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $imageRule = $this->isMethod('post') ? 'required' : 'nullable';

        return [
            'link'      => 'nullable|url|max:255',
            'ordem'     => 'required|integer',
            'carrossel' => 'boolean',
            'imagem'    => "$imageRule|image|mimes:jpg,jpeg,png|max:20480",
        ];
    }

    public function messages(): array
    {
        return [
            'imagem.required' => 'A imagem é obrigatória ao criar um banner.',
            'imagem.image'    => 'O arquivo deve ser uma imagem válida.',
            'imagem.max'      => 'A imagem não pode ultrapassar 20MB.',
            'link.url'        => 'O link deve ser uma URL válida.',
        ];
    }
}
