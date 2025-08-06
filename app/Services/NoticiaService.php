<?php

namespace App\Services;

use App\Models\Noticia;
use Illuminate\Support\Str;
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
        try {
            // Gera o slug a partir do título
            $data['slug'] = $this->generateUniqueSlug($data['titulo']);

            // Processa a imagem
            if (isset($data['imagem']) && $data['imagem']->isValid()) {
                $imagem = $data['imagem'];
                $nomeImagem = uniqid() . '.' . $imagem->getClientOriginalExtension();
                $imagem->move(public_path('news'), $nomeImagem);
                $data['imagem'] = 'news/' . $nomeImagem;
            }

            // Garante que ativo é booleano
            $data['ativo'] = $data['ativo'] ?? false;

            return Noticia::create($data);
        } catch (\Exception $e) {
            // Remove a imagem se foi salva mas ocorreu outro erro
            if (isset($data['imagem'])) {
                Storage::disk('public')->delete($data['imagem']);
            }
            throw $e;
        }
    }

    public function update(int $id, array $data): Noticia
    {
        $noticia = $this->find($id);

        // Se o título foi alterado, gera um novo slug
        if (isset($data['titulo']) && $noticia->titulo !== $data['titulo']) {
            $data['slug'] = $this->generateUniqueSlug($data['titulo'], $noticia->id);
        }

        // Tratamento da imagem
        if (isset($data['imagem']) && $data['imagem'] instanceof \Illuminate\Http\UploadedFile) {
            if ($noticia->imagem) {
                Storage::disk('public')->delete($noticia->imagem);
            }
            $imagem = $data['imagem'];
            $nomeImagem = uniqid() . '.' . $imagem->getClientOriginalExtension();
            $imagem->move(public_path('news'), $nomeImagem);
            $data['imagem'] = 'news/' . $nomeImagem;
        } elseif (isset($data['remover_imagem']) && $data['remover_imagem']) {
            if ($noticia->imagem && file_exists(public_path($noticia->imagem))) {
                unlink(public_path($noticia->imagem));
            }
            $data['imagem'] = null;
        } else {
            unset($data['imagem']);
        }

        $noticia->update($data);
        return $noticia;
    }

    /**
     * Gera um slug único baseado no título.
     *
     * @param string $title
     * @param int|null $excludeId
     * @return string
     */
    protected function generateUniqueSlug(string $title, ?int $excludeId = null): string
    {
        $slug = Str::slug($title);
        $originalSlug = $slug;
        $count = 1;

        while ($this->slugExists($slug, $excludeId)) {
            $slug = $originalSlug . '-' . $count++;
        }

        return $slug;
    }

    /**
     * Verifica se um slug já existe.
     *
     * @param string $slug
     * @param int|null $excludeId
     * @return bool
     */
    protected function slugExists(string $slug, ?int $excludeId = null): bool
    {
        $query = Noticia::where('slug', $slug);

        if ($excludeId) {
            $query->where('id', '!=', $excludeId);
        }

        return $query->exists();
    }

    /**
     * Exclui uma notícia.
     */
    public function delete(int $id): bool
    {
        $noticia = $this->find($id);

        if ($noticia->imagem && file_exists(public_path($noticia->imagem))) {
            unlink(public_path($noticia->imagem));
        }

        return $noticia->delete();
    }
}
