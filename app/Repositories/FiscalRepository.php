<?php

namespace App\Repositories;

use App\Models\Fiscal;

class FiscalRepository
{
    public function all() {
        return Fiscal::with(['obra'])->get();
    }

    public function find($id) {
        return Fiscal::with(['obra'])->findOrFail($id);
    }

    public function create(array $data) {
        return Fiscal::create($data);
    }

    public function update(Fiscal $fiscal, array $data) {
        $fiscal->update($data);
        return $fiscal;
    }

    public function delete(Fiscal $fiscal) {
        return $fiscal->delete();
    }
}
