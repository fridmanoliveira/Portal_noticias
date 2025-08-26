<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AndamentoObraRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'titulo' => ['required','string','min:3','max:100'],
            'descricao' => ['nullable','string'],
            'progresso' => ['required','integer','between:0,100'],
            'data' => ['required','date','before_or_equal:today'],
            'anexo' => ['nullable','file','mimes:pdf,doc,docx,png,jpg,jpeg','max:20480'],
            'obra_id' => ['required','exists:obras,id'],
        ];
    }
}
