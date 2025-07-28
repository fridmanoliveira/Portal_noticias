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
        if (isset($data['icone']) && $data['icone']->isValid()) {
            $data['icone'] = $data['icone']->store('acessos-rapidos', 'public');
        }

        return AcessoRapido::create($data);
    }

    public function update(int $id, array $data): AcessoRapido
    {
        $acesso = $this->find($id);

        if (isset($data['icone']) && $data['icone']->isValid()) {
            if ($acesso->icone && Storage::disk('public')->exists($acesso->icone)) {
                Storage::disk('public')->delete($acesso->icone);
            }

            $data['icone'] = $data['icone']->store('acessos-rapidos', 'public');
        }

        $acesso->update($data);
        return $acesso;
    }

    public function delete(int $id): bool
    {
        $acesso = $this->find($id);

        if ($acesso->icone && Storage::disk('public')->exists($acesso->icone)) {
            Storage::disk('public')->delete($acesso->icone);
        }

        return $acesso->delete();
    }
}
