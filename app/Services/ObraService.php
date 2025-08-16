<?php

namespace App\Services;

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
        return $this->obraRepository->create($data);
    }

    public function atualizarObra($id, array $data) {
        $obra = $this->obraRepository->find($id);
        return $this->obraRepository->update($obra, $data);
    }

    public function excluirObra($id) {
        $obra = $this->obraRepository->find($id);
        return $this->obraRepository->delete($obra);
    }
}
