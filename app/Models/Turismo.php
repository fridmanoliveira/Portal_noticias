<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Turismo extends Model
{
    protected $fillable = [
        'titulo',
        'descricao',
        'ativo',
    ];
    protected $casts = [
        'ativo' => 'boolean',
    ];

    public function imagens()
    {
        return $this->hasMany(GalaleiriaImagesTurismo::class, 'turismo_id');
    }
}
