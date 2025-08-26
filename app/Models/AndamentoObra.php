<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AndamentoObra extends Model
{
    protected $table = 'andamento_obra';

    protected $fillable = [
        'obra_id',
        'titulo',
        'descricao',
        'anexo',
        'data',
        'progresso',
    ];

    public function obra()
    {
        return $this->belongsTo(Obra::class, 'obra_id');
    }
}
