<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Number;
use Illuminate\Support\Str;


class Obra extends Model
{
    use HasFactory;

    protected $fillable = [
        'descricao',
        'slug',
        'fonte_recurso',
        'data_inicio',
        'data_conclusao',
        'situacao',
        'valor',
        'valor_aditado',
        'prazo_aditado',
        'fiscal_id',
        'empresa_id',
        'latitude',
        'longitude',
    ];

    protected $casts = [
        'data_inicio'      => 'date',
        'data_conclusao'   => 'date',
        'valor'            => 'decimal:2',
        'valor_aditado'    => 'decimal:2',
        'prazo_aditado'    => 'integer',
        'latitude'         => 'decimal:8',
        'longitude'        => 'decimal:8',
    ];



    // Relacionamentos
    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }

    public function andamentos()
    {
        return $this->hasMany(AndamentoObra::class);
    }

    public function fiscal()
    {
        return $this->belongsTo(Fiscal::class);
    }

    public function imagens()
    {
        return $this->hasMany(ImagemObra::class, 'obra_id');
    }

    protected static function booted()
    {
        static::creating(function ($obra) {
            $obra->slug = Str::slug($obra->titulo);
        });

        static::updating(function ($obra) {
            if ($obra->isDirty('titulo')) {
                $obra->slug = Str::slug($obra->titulo);
            }
        });
    }

    // Acessors "pt-BR"
    public function getValorFormatadoAttribute(): string
    {
        // Laravel 11+: Number::currency; para versões antigas, mantenha number_format
        return 'R$ ' . number_format((float) $this->valor, 2, ',', '.');
        // return Number::currency($this->valor, in: 'BRL', locale: 'pt_BR');
    }

    public function getValorAditadoFormatadoAttribute(): ?string
    {
        if ($this->valor_aditado === null) return null;
        return 'R$ ' . number_format((float) $this->valor_aditado, 2, ',', '.');
    }

    public function getDataInicioFormatadaAttribute(): string
    {
        return $this->data_inicio?->format('d/m/Y') ?? '-';
    }

    public function getDataConclusaoFormatadaAttribute(): string
    {
        return $this->data_conclusao?->format('d/m/Y') ?? '-';
    }

}
