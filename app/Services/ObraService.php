<?php

namespace App\Services;

use App\Models\ImagemObra;
use App\Models\Obra;
use App\Repositories\ObraRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ObraService
{
    public function __construct(
        protected ObraRepository $obraRepository
    ) {}

    public function listarObras()
    {
        return $this->obraRepository->all();
    }

    public function detalhesObra(Obra $obra): Obra
    {
        return $this->obraRepository->find($obra->id, ['imagens', 'empresa', 'fiscal'])
            ?? $obra->load(['imagens', 'empresa', 'fiscal']);
    }

    public function criarObra(array $data, Request $request): Obra
    {
        if (empty($data['slug']) && !empty($data['descricao'])) {
            $data['slug'] = $this->gerarSlugUnico($data['descricao']);
        }

        $obra = $this->obraRepository->create($data);

        // Upload imagens (salvando em /public/obras)
        if ($request->hasFile('imagens')) {
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

        return $obra->load('imagens');
    }

    public function atualizarObra(Obra $obra, array $data, Request $request): Obra
    {
        if (array_key_exists('slug', $data) && empty($data['slug']) && !empty($obra->descricao)) {
            $data['slug'] = $obra->slug ?: $this->gerarSlugUnico($obra->descricao);
        }

        $this->obraRepository->update($obra, $data);

        // Remover imagens
        if (!empty($data['remover_imagens'])) {
            foreach ($data['remover_imagens'] as $imagemId) {
                $imagem = ImagemObra::find($imagemId);
                if ($imagem && $imagem->obra_id === $obra->id) {
                    if (file_exists(public_path($imagem->image_path))) {
                        unlink(public_path($imagem->image_path));
                    }
                    $imagem->delete();
                }
            }
        }

        // Upload novas imagens
        if ($request->hasFile('imagens')) {
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

        return $obra->load('imagens');
    }

    public function excluirObra(Obra $obra): bool
    {
        foreach ($obra->imagens as $img) {
            if (file_exists(public_path($img->image_path))) {
                unlink(public_path($img->image_path));
            }
            $img->delete();
        }

        return (bool) $this->obraRepository->delete($obra);
    }

    protected function gerarSlugUnico(string $base): string
    {
        $slug = Str::slug(Str::limit($base, 60, ''), '-');

        $original = $slug;
        $i = 1;
        while (Obra::where('slug', $slug)->exists()) {
            $slug = "{$original}-{$i}";
            $i++;
        }
        return $slug;
    }
}
