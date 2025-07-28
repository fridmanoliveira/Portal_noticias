<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BannerRequest extends FormRequest
{
    /**
     * Autoriza todos os usuários a fazerem a requisição.
     * Ajuste aqui se quiser aplicar políticas.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Regras de validação para criação e edição de banners.
     */
    public function rules(): array
    {
        $imagemRule = $this->isMethod('post') ? 'required' : 'nullable';

        return [
            'titulo'     => 'required|string|max:255',
            'link'       => 'nullable|url|max:255',
            'ordem'      => 'required|integer',
            'carrossel'  => 'boolean',
            'imagem'     => "$imagemRule|image|max:20480",
        ];
    }

    /**
     * Mensagens de erro personalizadas (opcional).
     */
    public function messages(): array
    {
        return [
            'titulo.required'    => 'O título é obrigatório.',
            'imagem.required'    => 'A imagem é obrigatória para criar um banner.',
            'imagem.image'       => 'O arquivo deve ser uma imagem válida.',
            'imagem.max'         => 'A imagem não pode ter mais de 20MB.',
            'link.url'           => 'O link deve ser uma URL válida.',
        ];
    }
}
