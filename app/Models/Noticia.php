<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Noticia extends Model
{
    use HasFactory;
    protected $fillable = [
        'titulo',
        'slug',
        'resumo',
        'imagem',
        'publicado_em',
        'conteudo',
        'ativo',
        'categoria_id',
    ];

    // Adicione esta propriedade para que o Laravel converta automaticamente
    // 'publicado_em' para um objeto Carbon.
    protected $casts = [
        'publicado_em' => 'datetime',
        'ativo' => 'boolean', // Boa prática também para o campo ativo
    ];

    public function categoria()
    {
        return $this->belongsTo(CategoriaNoticia::class, 'categoria_id');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
