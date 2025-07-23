<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RedeSocial extends Model
{
    protected $fillable = ['nome', 'url', 'icone', 'ordem', 'ativo'];
}
