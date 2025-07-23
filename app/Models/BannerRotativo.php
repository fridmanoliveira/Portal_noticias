<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BannerRotativo extends Model
{
    protected $fillable = ['imagem', 'link', 'titulo', 'ordem', 'ativo'];
}
