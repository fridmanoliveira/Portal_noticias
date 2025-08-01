<?php


namespace Database\Factories;

use App\Models\Noticia;
use App\Models\CategoriaNoticia;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class NoticiaFactory extends Factory
{
    protected $model = Noticia::class;

    public function definition(): array
    {
        $titulo = $this->faker->sentence(6);
        $slug = Str::slug($titulo);

        return [
            'titulo' => $titulo,
            'resumo' => $this->faker->text(200),
            'slug' => $slug,
            'publicado_em' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'conteudo' => $this->faker->paragraphs(5, true),
            'imagem' => 'noticias/VjORt6kRnhoZ5AHA2tsObQmBR89qHV5wQs6RsXPB.png',
            'ativo' => $this->faker->boolean(),
            'categoria_id' => CategoriaNoticia::factory(),
        ];
    }
}
