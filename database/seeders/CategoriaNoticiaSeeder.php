<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CategoriaNoticia;

class CategoriaNoticiaSeeder extends Seeder
{
    public function run(): void
    {
        $categorias = [
            'Educação',
            'Saúde',
            'Infraestrutura',
            'Esporte',
            'Cultura',
        ];

        foreach ($categorias as $i => $nome) {
            CategoriaNoticia::create([
                'nome' => $nome,
                'ativo' => true,
            ]);
        }
    }
}
