<?php

namespace Database\Factories;

use App\Models\CategoriaNoticia;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoriaNoticiaFactory extends Factory
{
    protected $model = CategoriaNoticia::class;

    public function definition(): array
    {
        return [
            'nome' => $this->faker->unique()->words(2, true),
            'ativo' => $this->faker->boolean(),
        ];
    }
}
