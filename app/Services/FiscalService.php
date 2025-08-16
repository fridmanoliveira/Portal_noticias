<?php

namespace App\Services;

use App\Repositories\FiscalRepository;

class FiscalService
{
    protected $fiscalRepository;

    public function __construct(FiscalRepository $fiscalRepository) {
        $this->fiscalRepository = $fiscalRepository;
    }

    public function listarFiscais() {
        return $this->fiscalRepository->all();
    }

    public function detalhesFiscal($id) {
        return $this->fiscalRepository->find($id);
    }

    public function criarFiscal(array $data) {
        return $this->fiscalRepository->create($data);
    }

    public function atualizarFiscal($id, array $data) {
        $fiscal = $this->fiscalRepository->find($id);
        return $this->fiscalRepository->update($fiscal, $data);
    }

    public function excluirFiscal($id) {
        $fiscal = $this->fiscalRepository->find($id);
        return $this->fiscalRepository->delete($fiscal);
    }
}
