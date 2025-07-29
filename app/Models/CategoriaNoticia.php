<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoriaNoticia extends Model
{
    protected $fillable = ['nome', 'ativo'];

    protected $casts = [
        'ativo' => 'boolean',
    ];

    public function noticias() {
        return $this->hasMany(Noticia::class, 'categoria_id');
    }
}
