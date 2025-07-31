<?php

namespace App\Services;

use App\Models\Noticia;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Collection;

class NoticiaService
{
    /**
     * Retorna todas as notícias ativas, ordenadas pela data de publicação.
     */
    public function all(): Collection
    {
        return Noticia::where('ativo', true)
                      ->orderByDesc('publicado_em')
                      ->get();
    }

    /**
     * Retorna todas as notícias, ativas ou inativas, ordenadas pela data de publicação (para o admin).
     */
    public function getAllForAdmin(): Collection
    {
        return Noticia::orderByDesc('publicado_em')->get();
    }

    /**
     * Encontra uma notícia pelo ID.
     */
    public function find(int $id): Noticia
    {
        return Noticia::findOrFail($id);
    }

    /**
     * Retorna a notícia principal (a mais recente e ativa).
     */
    public function getNoticiaPrincipal(): ?Noticia
    {
        return Noticia::where('ativo', true)
                      ->orderByDesc('publicado_em')
                      ->first();
    }

    /**
     * Retorna as últimas 3 notícias (excluindo a principal, se houver).
     */
    public function getLatestNoticias(int $limit = 3, ?int $excludeId = null): Collection
    {
        $query = Noticia::where('ativo', true)
                        ->orderByDesc('publicado_em');

        if ($excludeId) {
            $query->where('id', '!=', $excludeId);
        }

        return $query->take($limit)->get();
    }

    /**
     * Armazena uma nova notícia.
     */
    public function store(array $data): Noticia
    {
        if (isset($data['imagem']) && $data['imagem']->isValid()) {
            $data['imagem'] = $data['imagem']->store('noticias', 'public');
        }

        return Noticia::create($data);
    }

    /**
     * Atualiza uma notícia existente.
     */
    public function update(int $id, array $data): Noticia
    {
        $noticia = $this->find($id);

        if (isset($data['imagem']) && $data['imagem']->isValid()) {
            // Remove a imagem antiga se existir
            if ($noticia->imagem && Storage::disk('public')->exists($noticia->imagem)) {
                Storage::disk('public')->delete($noticia->imagem);
            }
            $data['imagem'] = $data['imagem']->store('noticias', 'public');
        } elseif (isset($data['imagem']) && $data['imagem'] === null) {
            // Caso a imagem seja removida no formulário
            if ($noticia->imagem && Storage::disk('public')->exists($noticia->imagem)) {
                Storage::disk('public')->delete($noticia->imagem);
            }
            $data['imagem'] = null; // Garante que o campo será limpo no DB
        }

        $noticia->update($data);
        return $noticia;
    }

    /**
     * Exclui uma notícia.
     */
    public function delete(int $id): bool
    {
        $noticia = $this->find($id);

        if ($noticia->imagem && Storage::disk('public')->exists($noticia->imagem)) {
            Storage::disk('public')->delete($noticia->imagem);
        }

        return $noticia->delete();
    }
}
