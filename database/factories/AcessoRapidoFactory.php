<?php

namespace Database\Factories;

use App\Models\AcessoRapido;
use Illuminate\Database\Eloquent\Factories\Factory;

class AcessoRapidoFactory extends Factory
{
    protected $model = AcessoRapido::class;

    public function definition(): array
    {
        return [
            'titulo' => 'Acesso Rápido',
            'icone' => 'acessos-rapidos/DeAZxmBmMhsA1dpXKlTzfWTk5uKf18Y4YO1kKhpY.png',
            'link' => '#',
            'ordem' => 1,
            'ativo' => true,
        ];
    }

    public function portalTransparencia()
    {
        return $this->state([
            'titulo' => 'Portal da Transparência',
            'link' => 'https://example.com/transparencia',
            'ordem' => 1,
        ]);
    }

    public function nfe()
    {
        return $this->state([
            'titulo' => 'NF-e',
            'link' => 'https://example.com/nfe',
            'ordem' => 2,
        ]);
    }

    public function alvara()
    {
        return $this->state([
            'titulo' => 'ALVARÁ',
            'link' => 'https://example.com/alvara',
            'ordem' => 3,
        ]);
    }

    public function diarioOficial()
    {
        return $this->state([
            'titulo' => 'DIÁRIO OFICIAL',
            'link' => 'https://example.com/diario-oficial',
            'ordem' => 4,
        ]);
    }

    public function esic()
    {
        return $this->state([
            'titulo' => 'e-SIC',
            'link' => 'https://example.com/esic',
            'ordem' => 5,
        ]);
    }

    public function iptu()
    {
        return $this->state([
            'titulo' => 'IPTU CIDADÃO',
            'link' => 'https://example.com/iptu',
            'ordem' => 6,
        ]);
    }

    public function legislacoes()
    {
        return $this->state([
            'titulo' => 'LEGISLAÇÕES',
            'link' => 'https://example.com/legislacoes',
            'ordem' => 7,
        ]);
    }

    public function contracheque()
    {
        return $this->state([
            'titulo' => 'CONTRACHEQUE 2025',
            'link' => 'https://example.com/contracheque',
            'ordem' => 8,
        ]);
    }

    public function withIcon(string $filename)
    {
        return $this->state([
            'icone' => 'acessos-rapidos/DeAZxmBmMhsA1dpXKlTzfWTk5uKf18Y4YO1kKhpY.png' . $filename,
        ]);
    }
}
