<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MapaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'titulo'      => ['required', 'string', 'max:255'],
            'descricao'   => ['nullable', 'string'],
            'texto_botao' => ['required', 'string', 'max:100'],
            'ativo'       => ['nullable', 'boolean'],
        ];

        if ($this->isMethod('POST')) {
            $rules['arquivo_pdf'] = ['required', 'file', 'mimes:pdf', 'max:10240']; // 10MB
        } else {
            $rules['arquivo_pdf'] = ['nullable', 'file', 'mimes:pdf', 'max:10240'];
        }

        return $rules;
    }
}
