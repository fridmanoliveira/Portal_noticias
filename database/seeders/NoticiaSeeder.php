<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Noticia;
use App\Models\CategoriaNoticia;

class NoticiaSeeder extends Seeder
{
    public function run(): void
    {
        $categorias = CategoriaNoticia::all();

        foreach ($categorias as $categoria) {
            Noticia::factory(5)->create([
                'categoria_id' => $categoria->id,
            ]);
        }
    }
}
