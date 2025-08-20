<?php

namespace App\Services;

use App\Models\ImagemObra;
use App\Repositories\ObraRepository;

class ObraService
{
    protected $obraRepository;

    public function __construct(ObraRepository $obraRepository) {
        $this->obraRepository = $obraRepository;
    }

    public function listarObras() {
        return $this->obraRepository->all();
    }

    public function detalhesObra($id) {
        return $this->obraRepository->find($id);
    }

    public function criarObra(array $data) {
        $obra = $this->obraRepository->create($data);

        // Upload imagens
        if (request()->hasFile('imagens')) {
            foreach (request()->file('imagens') as $imagem) {
                if ($imagem->isValid()) {
                    $nomeImagem = uniqid() . '.' . $imagem->getClientOriginalExtension();
                    $imagem->move(public_path('obras'), $nomeImagem);

                    ImagemObra::create([
                        'obra_id' => $obra->id,
                        'image_path' => 'obras/' . $nomeImagem,
                    ]);
                }
            }
        }

        return $obra;
    }

    public function atualizarObra($id, array $data) {
        $obra = $this->obraRepository->find($id);
        $this->obraRepository->update($obra, $data);

        // Remover imagens
        if (!empty($data['remover_imagens'])) {
            foreach ($data['remover_imagens'] as $imagemId) {
                $imagem = ImagemObra::find($imagemId);
                if ($imagem) {
                    if (file_exists(public_path($imagem->image_path))) {
                        unlink(public_path($imagem->image_path));
                    }
                    $imagem->delete();
                }
            }
        }

        // Upload novas imagens
        if (request()->hasFile('imagens')) {
            foreach (request()->file('imagens') as $imagem) {
                if ($imagem->isValid()) {
                    $nomeImagem = uniqid() . '.' . $imagem->getClientOriginalExtension();
                    $imagem->move(public_path('obras'), $nomeImagem);

                    ImagemObra::create([
                        'obra_id' => $obra->id,
                        'image_path' => 'obras/' . $nomeImagem,
                    ]);
                }
            }
        }

        return $obra;
    }

    public function excluirObra($id) {
        $obra = $this->obraRepository->find($id);

        // Deleta imagens associadas
        foreach ($obra->imagens as $img) {
            if (file_exists(public_path($img->image_path))) {
                unlink(public_path($img->image_path));
            }
            $img->delete();
        }

        return $this->obraRepository->delete($obra);
    }
}
