<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AcessoRapido extends Model
{
    protected $fillable = ['titulo', 'descricao', 'icone', 'link', 'ordem', 'ativo'];
}
