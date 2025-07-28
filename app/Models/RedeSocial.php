<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RedeSocial extends Model
{
    protected $table = 'redes_sociais';
    protected $fillable = ['nome', 'url', 'icone', 'ordem', 'ativo'];
}
