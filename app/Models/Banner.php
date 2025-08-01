<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $fillable = ['titulo', 'imagem', 'link', 'carrossel', 'ordem', 'ativo'];
}
