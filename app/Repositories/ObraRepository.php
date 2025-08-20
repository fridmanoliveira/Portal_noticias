<?php

namespace App\Repositories;

use App\Models\Obra;

class ObraRepository
{
    public function all() {
        return Obra::with(['empresa', 'fiscal', 'imagens'])->get();
    }

    public function find($id) {
        return Obra::with(['empresa', 'fiscal', 'imagens'])->findOrFail($id);
    }

    public function create(array $data) {
        return Obra::create($data);
    }

    public function update(Obra $obra, array $data) {
        $obra->update($data);
        return $obra;
    }

    public function delete(Obra $obra) {
        return $obra->delete();
    }
}
