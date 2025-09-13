<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MapaRequest;
use App\Services\MapaService;

class AdminMapaController extends Controller
{
    protected $mapaService;

    public function __construct(MapaService $mapaService)
    {
        $this->mapaService = $mapaService;
    }

    public function index()
    {
        $mapas = $this->mapaService->getAll();
        return view('admin.mapas.index', compact('mapas'));
    }

    public function create()
    {
        return view('admin.mapas.create');
    }

    public function store(MapaRequest $request)
    {
        $this->mapaService->store($request);
        return redirect()->route('admin.mapas.index')->with('success', 'Página de Mapas cadastrada com sucesso.');
    }

    public function edit(string $id)
    {
        $mapa = $this->mapaService->findById($id);
        return view('admin.mapas.edit', compact('mapa'));
    }

    public function update(MapaRequest $request, string $id)
    {
        $this->mapaService->update($id, $request);
        return redirect()->route('admin.mapas.index')->with('success', 'Página de Mapas atualizada com sucesso.');
    }

    public function destroy(string $id)
    {
        $this->mapaService->delete($id);
        return redirect()->route('admin.mapas.index')->with('success', 'Página de Mapas removida com sucesso.');
    }
}
