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
        'empresa_id',
        'latitude',
        'longitude',
    ];

    protected $casts = [

        'data_inicio' => 'date',
        'data_conclusao' => 'date',
    ];
    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }

    public function fiscal()
    {
        return $this->belongsTo(Fiscal::class);
    }

    public function getValorFormatadoAttribute()
    {
        return 'R$ ' . number_format($this->valor, 2, ',', '.');
    }

    public function getDataInicioFormatadaAttribute()
    {
        return $this->data_inicio ? $this->data_inicio->format('d/m/Y') : '-';
    }

    public function getDataConclusaoFormatadaAttribute()
    {
        return $this->data_conclusao ? $this->data_conclusao->format('d/m/Y') : '-';
    }

    public function imagens()
    {
        return $this->hasMany(ImagemObra::class, 'obra_id');
    }
}
