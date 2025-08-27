<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
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

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    // Relacionamentos
    public function empresa() { return $this->belongsTo(Empresa::class); }
    public function fiscal() { return $this->belongsTo(Fiscal::class); }
    public function andamentos() { return $this->hasMany(AndamentoObra::class); }
    public function imagens() { return $this->hasMany(ImagemObra::class, 'obra_id'); }

    // Boot: gera slug automaticamente
    protected static function booted()
    {
        static::creating(function ($obra) {
            if (empty($obra->slug) && $obra->descricao) {
                $obra->slug = static::gerarSlugUnico($obra->descricao);
            }
        });

        static::updating(function ($obra) {
            if ($obra->isDirty('descricao') && empty($obra->slug)) {
                $obra->slug = static::gerarSlugUnico($obra->descricao);
            }
        });
    }

    // Acessors
    public function getValorFormatadoAttribute(): string
    {
        return 'R$ ' . number_format((float)$this->valor, 2, ',', '.');
    }

    public function getValorAditadoFormatadoAttribute(): ?string
    {
        return $this->valor_aditado !== null
            ? 'R$ ' . number_format((float)$this->valor_aditado, 2, ',', '.')
            : null;
    }

    public function getDataInicioFormatadaAttribute(): string
    {
        return $this->data_inicio?->format('d/m/Y') ?? '-';
    }

    public function getDataConclusaoFormatadaAttribute(): string
    {
        return $this->data_conclusao?->format('d/m/Y') ?? '-';
    }

    // Método estático para gerar slug único
    public static function gerarSlugUnico(string $descricao): string
    {
        $slug = Str::slug(Str::limit($descricao, 60, ''), '-');
        $original = $slug;
        $i = 1;
        while (self::where('slug', $slug)->exists()) {
            $slug = "{$original}-{$i}";
            $i++;
        }
        return $slug;
    }
}
