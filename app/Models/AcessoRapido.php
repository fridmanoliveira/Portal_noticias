<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AcessoRapido extends Model
{
    use HasFactory;
    protected $table = 'acessos_rapidos';
    protected $fillable = ['titulo', 'icone', 'link', 'ordem', 'ativo'];

    protected $casts = [
    'ativo' => 'boolean',
];
}
