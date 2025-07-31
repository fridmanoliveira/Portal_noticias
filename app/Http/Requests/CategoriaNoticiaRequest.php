<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoriaNoticiaRequest extends FormRequest
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
    public function rules(): array
    {
        // Obtém o ID da categoria diretamente do parâmetro da rota como string.
        // O nome do parâmetro é 'categorias_noticia' para a rota resource.
        $categoriaId = $this->route('categorias_noticia');

        return [
            // A regra 'unique' agora ignora o registro com o ID atual, usando o ID diretamente.
            // Se $categoriaId for nulo (rota de criação), 'NULL' será usado.
            'nome' => 'required|string|max:255|unique:categoria_noticias,nome,' . ($categoriaId ?? 'NULL') . ',id',
            'ativo' => 'boolean',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'nome.required' => 'O campo nome é obrigatório.',
            'nome.unique' => 'Já existe uma categoria com este nome.',
            'nome.max' => 'O nome não pode ter mais de :max caracteres.',
            'ativo.boolean' => 'O campo ativo deve ser verdadeiro ou falso.',
        ];
    }
}
