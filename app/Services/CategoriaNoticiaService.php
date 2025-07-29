<?php

namespace App\Services;

use App\Models\CategoriaNoticia;
use Illuminate\Database\Eloquent\Collection;

class CategoriaNoticiaService
{
    /**
     * Retorna todas as categorias de notícias ativas.
     */
    public function all(): Collection
    {
        return CategoriaNoticia::where('ativo', true)->get();
    }

        public function getAllForAdmin(): Collection
    {
        return CategoriaNoticia::all(); // Não precisa de order by aqui, a menos que queira
    }

    /**
     * Encontra uma categoria de notícia pelo ID.
     */
    public function find(int $id): CategoriaNoticia
    {
        return CategoriaNoticia::findOrFail($id);
    }

    /**
     * Armazena uma nova categoria de notícia.
     */
    public function store(array $data): CategoriaNoticia
    {
        return CategoriaNoticia::create($data);
    }

    /**
     * Atualiza uma categoria de notícia existente.
     */
    public function update(int $id, array $data): CategoriaNoticia
    {
        $categoria = $this->find($id);
        $categoria->update($data);
        return $categoria;
    }

    /**
     * Exclui uma categoria de notícia.
     */
    public function delete(int $id): bool
    {
        $categoria = $this->find($id);
        return $categoria->delete();
    }
}
