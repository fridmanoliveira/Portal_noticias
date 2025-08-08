<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TurismoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'titulo' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'ativo' => 'nullable|boolean',
            'imagens.*' => 'nullable|image|max:20048',
            'remover_imagens' => 'nullable|array',
            'remover_imagens.*' => 'integer|exists:galeria_images_turismo,id',
        ];
    }
}
