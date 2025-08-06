<?php

namespace App\Services;

use App\Models\AcessoRapido;
use Illuminate\Support\Facades\Storage;

class AcessoRapidoService
{
    public function all()
    {
        return AcessoRapido::orderBy('ordem')->get();
    }

    public function find(int $id): AcessoRapido
    {
        return AcessoRapido::findOrFail($id);
    }

    public function store(array $data): AcessoRapido
    {
        try {
            if (isset($data['icone']) && $data['icone']->isValid()) {
                $icone = $data['icone'];
                $nomeArquivo = uniqid() . '.' . $icone->getClientOriginalExtension();
                $icone->move(public_path('acessos-rapidos'), $nomeArquivo);
                $data['icone'] = 'acessos-rapidos/' . $nomeArquivo;
            }

            return AcessoRapido::create($data);
        } catch (\Exception $e) {
            if (isset($data['icone'])) {
                Storage::disk('public')->delete($data['icone']);
            }
            throw $e;
        }
    }

    public function update(int $id, array $data): AcessoRapido
    {
        $acesso = $this->find($id);

        if (isset($data['icone']) && $data['icone']->isValid()) {
            // Remove o ícone anterior
            if ($acesso->icone && file_exists(public_path($acesso->icone))) {
                unlink(public_path($acesso->icone));
            }

            $icone = $data['icone'];
            $nomeArquivo = uniqid() . '.' . $icone->getClientOriginalExtension();
            $icone->move(public_path('acessos-rapidos'), $nomeArquivo);
            $data['icone'] = 'acessos-rapidos/' . $nomeArquivo;
        } elseif (isset($data['remover_icone']) && $data['remover_icone']) {
            if ($acesso->icone && file_exists(public_path($acesso->icone))) {
                unlink(public_path($acesso->icone));
            }
            $data['icone'] = null;
        } else {
            unset($data['icone']); // Evita sobrescrever com valor inválido
        }

        $acesso->update($data);
        return $acesso;
    }

    public function delete(int $id): bool
    {
        $acesso = $this->find($id);

        if ($acesso->icone && file_exists(public_path($acesso->icone))) {
            unlink(public_path($acesso->icone));
        }

        return $acesso->delete();
    }
}
