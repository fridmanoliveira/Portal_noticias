<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AcessoRapido extends Model
{
    protected $table = 'acessos_rapidos';
    protected $fillable = ['titulo', 'icone', 'link', 'ordem', 'ativo'];

    protected $casts = [
    'ativo' => 'boolean',
];
}
