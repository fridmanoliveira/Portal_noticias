<?php

namespace App\Services;

use App\Repositories\EmpresaRepository;

class EmpresaService
{
    protected $empresaRepository;

    public function __construct(EmpresaRepository $empresaRepository) {
        $this->empresaRepository = $empresaRepository;
    }

    public function listarEmpresas() {
        return $this->empresaRepository->all();
    }

    public function detalhesEmpresa($id) {
        return $this->empresaRepository->find($id);
    }

    public function criarEmpresa(array $data) {
        return $this->empresaRepository->create($data);
    }

    public function atualizarEmpresa($id, array $data) {
        $empresa = $this->empresaRepository->find($id);
        return $this->empresaRepository->update($empresa, $data);
    }

    public function excluirEmpresa($id) {
        $empresa = $this->empresaRepository->find($id);
        return $this->empresaRepository->delete($empresa);
    }
}
