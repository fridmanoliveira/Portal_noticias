<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Noticia extends Model
{
    protected $fillable = ['titulo', 'resumo', 'imagem', 'publicado_em', 'conteudo', 'ativo'];
}
