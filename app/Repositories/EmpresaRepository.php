<?php

namespace App\Repositories;

use App\Models\Empresa;

class EmpresaRepository
{
    public function all() {
        return Empresa::with(['obras'])->get();
    }

    public function find($id) {
        return Empresa::with(['obras'])->findOrFail($id);
    }

    public function create(array $data) {
        return Empresa::create($data);
    }

    public function update(Empresa $empresa, array $data) {
        $empresa->update($data);
        return $empresa;
    }

    public function delete(Empresa $empresa) {
        return $empresa->delete();
    }
}
