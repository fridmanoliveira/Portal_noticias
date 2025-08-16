<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Obra extends Model
{
    use HasFactory;

    protected $fillable = [
        'descricao',
        'fonte_recurso',
        'data_inicio',
        'data_conclusao',
        'situacao',
        'etapa_atual',
        'valor',
        'valor_aditado',
        'prazo_aditado',
        'fiscal_id',
        'empresa_id'
    ];

    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }

    public function fiscais()
    {
        return $this->belongsTo(Fiscal::class);
    }
}
