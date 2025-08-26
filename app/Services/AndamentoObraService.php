<?php

namespace App\Services;

use App\Models\AndamentoObra;

class AndamentoObraService
{
    protected string $pastaAnexos = 'anexos';

    public function all()
    {
        return AndamentoObra::orderBy('data', 'desc')->get();
    }

    public function find(int $id): AndamentoObra
    {
        return AndamentoObra::findOrFail($id);
    }

    public function store(array $data): AndamentoObra
    {
        // Upload do anexo se existir
        if (isset($data['anexo']) && $data['anexo']->isValid()) {
            $data['anexo'] = $this->salvarAnexo($data['anexo']);
        }

        return AndamentoObra::create($data);
    }

    public function update(int $id, array $data): AndamentoObra
    {
        $andamento = $this->find($id);

        // Substituir anexo
        if (isset($data['anexo']) && $data['anexo']->isValid()) {
            // Apaga anexo antigo
            if ($andamento->anexo && file_exists(public_path($andamento->anexo))) {
                unlink(public_path($andamento->anexo));
            }
            $data['anexo'] = $this->salvarAnexo($data['anexo']);
        } elseif (isset($data['remover_anexo']) && $data['remover_anexo']) {
            // Remove anexo existente
            if ($andamento->anexo && file_exists(public_path($andamento->anexo))) {
                unlink(public_path($andamento->anexo));
            }
            $data['anexo'] = null;
        } else {
            unset($data['anexo']); // mantém o anexo existente
        }

        $andamento->update($data);
        return $andamento;
    }

    public function delete(int $id): bool
    {
        $andamento = $this->find($id);

        // Deleta o anexo, se existir
        if ($andamento->anexo && file_exists(public_path($andamento->anexo))) {
            unlink(public_path($andamento->anexo));
        }

        return $andamento->delete();
    }

    protected function salvarAnexo($arquivo): string
    {
        $nome = uniqid() . '.' . $arquivo->getClientOriginalExtension();
        $arquivo->move(public_path($this->pastaAnexos), $nome);
        return $this->pastaAnexos . '/' . $nome;
    }

}
