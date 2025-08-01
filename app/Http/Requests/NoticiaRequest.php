<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NoticiaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'ativo' => $this->has('ativo') ? filter_var($this->ativo, FILTER_VALIDATE_BOOLEAN) : false,
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        $rules = [
            'titulo' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:noticias,slug',
            'resumo' => 'required|string|max:500',
            'conteudo' => 'required|string',
            'categoria_id' => 'required|exists:categoria_noticias,id',
            'publicado_em' => 'required|date',
            'ativo' => 'boolean',
        ];

        // Na criação, a imagem é obrigatória
        if ($this->isMethod('post')) {
            $rules['imagem'] = 'required|image|mimes:jpeg,png,jpg,gif|max:20048';
        } else {
            // Na edição, a imagem é opcional
            $rules['imagem'] = 'nullable|image|mimes:jpeg,png,jpg,gif|max:20048';
            $rules['remover_imagem'] = 'nullable|boolean';
        }

        return $rules;
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'titulo.required' => 'O campo título é obrigatório.',
            'titulo.max' => 'O título não pode ter mais de :max caracteres.',
            'resumo.required' => 'O campo resumo é obrigatório.',
            'resumo.max' => 'O resumo não pode ter mais de :max caracteres.',
            'publicado_em.required' => 'O campo "publicado em" é obrigatório.',
            'publicado_em.date' => 'O campo "publicado em" deve ser uma data válida.',
            'conteudo.required' => 'O campo conteúdo é obrigatório.',
            'imagem.required' => 'A imagem da notícia é obrigatória.',
            'imagem.image' => 'O arquivo deve ser uma imagem.',
            'imagem.mimes' => 'A imagem deve ser dos tipos: jpeg, png, jpg, gif, webp.',
            'imagem.max' => 'A imagem não pode ter mais de 20MB.',
            'ativo.boolean' => 'O campo ativo deve ser verdadeiro ou falso.',
            'categoria_id.required' => 'A categoria da notícia é obrigatória.',
            'categoria_id.exists' => 'A categoria selecionada não é válida.',
        ];
    }
}
