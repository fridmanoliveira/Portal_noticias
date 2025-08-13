<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuestionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Ajuste conforme regras de autenticação
    }

    public function rules(): array
    {
        return [
            'title'          => 'required|string|max:255',
            'description'    => 'nullable|string|max:1000',
            'type'           => 'required|in:checkbox,radio',
            'order'          => 'nullable|integer|min:0',
            'is_required'    => 'boolean',
            'section'        => 'nullable|string|max:255',
            'options'        => 'required|array|min:1',
            'options.*'      => 'required|string|max:255',
        ];
    }
}
