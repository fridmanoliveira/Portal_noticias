<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TurismoRequest;
use App\Services\TurismoService;

class AdminTurismoController extends Controller
{
    protected $turismoService;

    public function __construct(TurismoService $turismoService)
    {
        $this->turismoService = $turismoService;
    }

    public function index()
    {
        $turismos = $this->turismoService->getAll();
        return view('admin.turismo.index', compact('turismos'));
    }

    public function create()
    {
        return view('admin.turismo.create');
    }

    public function store(TurismoRequest $request)
    {
        $this->turismoService->store($request->validated());

        return redirect()->route('admin.turismo.index')
                         ->with('success', 'Vídeo cadastrado com sucesso.');
    }

    public function edit(string $id)
    {
        $turismo = $this->turismoService->findById($id);
        return view('admin.turismo.edit', compact('turismo'));
    }

    public function update(TurismoRequest $request, string $id)
    {
        $this->turismoService->update($id, $request->validated());

        return redirect()->route('admin.turismo.index')
                         ->with('success', 'Vídeo atualizado com sucesso.');
    }

    public function destroy(string $id)
    {
        $this->turismoService->delete($id);

        return redirect()->route('admin.turismo.index')
                         ->with('success', 'Vídeo removido com sucesso.');
    }
}
