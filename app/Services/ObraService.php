<?php

namespace App\Services;

use App\Models\ImagemObra;
use App\Models\Obra;
use App\Repositories\ObraRepository;
use Illuminate\Http\Request;

class ObraService
{
    public function __construct(protected ObraRepository $obraRepository) {}

    public function listarObras() { return $this->obraRepository->all(); }

    public function detalhesObra(Obra $obra): Obra
    {
        return $this->obraRepository->find($obra->id, ['imagens','empresa','fiscal'])
            ?? $obra->load(['imagens','empresa','fiscal']);
    }

    public function criarObra(array $data, Request $request): Obra
    {
        if (empty($data['slug']) && !empty($data['descricao'])) {
            $data['slug'] = Obra::gerarSlugUnico($data['descricao']);
        }

        $obra = $this->obraRepository->create($data);
        $this->uploadImagens($obra, $request);

        return $obra->load('imagens');
    }

    public function atualizarObra(Obra $obra, array $data, Request $request): Obra
    {
        if (empty($data['slug']) && !empty($obra->descricao)) {
            $data['slug'] = $obra->slug ?: Obra::gerarSlugUnico($obra->descricao);
        }

        $this->obraRepository->update($obra, $data);

        $this->removerImagens($obra, $data['remover_imagens'] ?? []);
        $this->uploadImagens($obra, $request);

        return $obra->load('imagens');
    }

    public function excluirObra(Obra $obra): bool
    {
        $this->removerImagens($obra, $obra->imagens->pluck('id')->toArray());
        return (bool) $this->obraRepository->delete($obra);
    }

    protected function uploadImagens(Obra $obra, Request $request): void
    {
        if (!$request->hasFile('imagens')) return;

        foreach ($request->file('imagens') as $arquivo) {
            if ($arquivo->isValid()) {
                $nomeArquivo = uniqid() . '.' . $arquivo->getClientOriginalExtension();
                $arquivo->move(public_path('obras'), $nomeArquivo);

                ImagemObra::create([
                    'obra_id'    => $obra->id,
                    'image_path' => 'obras/' . $nomeArquivo,
                ]);
            }
        }
    }

    protected function removerImagens(Obra $obra, array $imagemIds): void
    {
        foreach ($imagemIds as $id) {
            $imagem = ImagemObra::find($id);
            if ($imagem && $imagem->obra_id === $obra->id) {
                if (file_exists(public_path($imagem->image_path))) {
                    unlink(public_path($imagem->image_path));
                }
                $imagem->delete();
            }
        }
    }
}
