<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CategoriaNoticia extends Model
{
    use HasFactory;
    protected $table = 'categoria_noticias'; // Defina o nome da tabela se for diferente do padrão
    protected $fillable = ['nome', 'ativo'];

    protected $casts = [
        'ativo' => 'boolean',
    ];

    public function noticias() {
        return $this->hasMany(Noticia::class, 'categoria_id');
    }
}
