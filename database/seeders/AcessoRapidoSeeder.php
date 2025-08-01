<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AcessoRapido;

class AcessoRapidoSeeder extends Seeder
{
    public function run(): void
    {
        AcessoRapido::factory()->portalTransparencia()
            ->withIcon('portal-transparencia.png')
            ->create();

        AcessoRapido::factory()->nfe()
            ->withIcon('nfe.png')
            ->create();

        AcessoRapido::factory()->alvara()
            ->withIcon('alvara.png')
            ->create();

        AcessoRapido::factory()->diarioOficial()
            ->withIcon('diario-oficial.png')
            ->create();

        AcessoRapido::factory()->esic()
            ->withIcon('esic.png')
            ->create();

        AcessoRapido::factory()->iptu()
            ->withIcon('iptu.png')
            ->create();

        AcessoRapido::factory()->legislacoes()
            ->withIcon('legislacoes.png')
            ->create();

        AcessoRapido::factory()->contracheque()
            ->withIcon('contracheque.png')
            ->create();
    }
}
