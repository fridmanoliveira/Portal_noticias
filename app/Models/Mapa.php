<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mapa extends Model
{
    protected $fillable = [
        'titulo',
        'descricao',
        'arquivo_pdf',
        'texto_botao',
        'ativo',
    ];
}
