<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AcessoRapidoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Coloque lógica de permissão se necessário
    }

    public function rules(): array
    {
        return [
            'titulo' => ['required', 'string', 'max:255'],
            'icone' => ['nullable', 'file', 'mimes:svg,png,jpg,jpeg', 'max:10048'],
            'link' => ['required', 'url'],
            'ordem' => ['nullable', 'integer'],
            'ativo' => ['nullable', 'boolean'],
        ];
    }
}
