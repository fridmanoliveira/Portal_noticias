<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AcessoRapidoRequest;
use App\Services\AcessoRapidoService;

class AcessoRapidoController extends Controller
{
    protected AcessoRapidoService $service;

    public function __construct(AcessoRapidoService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $acessos = $this->service->all();
        return view('admin.acessos-rapidos.index', compact('acessos'));
    }

    public function create()
    {
        return view('admin.acessos-rapidos.create');
    }

    public function store(AcessoRapidoRequest $request)
    {
        $data = $request->validated();
        $data['icone'] = $request->file('icone'); // pega o arquivo manualmente
        $this->service->store($data);

        return redirect()->route('admin.acessos-rapidos.index')->with('success', 'Acesso Rápido criado com sucesso!');
    }

    public function edit(int $id)
    {
        $acesso = $this->service->find($id);
        return view('admin.acessos-rapidos.edit', compact('acesso'));
    }

    public function update(AcessoRapidoRequest $request, int $id)
    {
        $data = $request->validated();
        $data['icone'] = $request->file('icone'); // idem
        $this->service->update($id, $data);

        return redirect()->route('admin.acessos-rapidos.index')->with('success', 'Acesso Rápido atualizado!');
    }

    public function destroy(int $id)
    {
        $this->service->delete($id);
        return redirect()->route('admin.acessos-rapidos.index')->with('success', 'Acesso Rápido removido!');
    }
}
