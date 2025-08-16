<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\EmpresaService;

class EmpresaController extends Controller
{
    protected $service;

    public function __construct(EmpresaService $service) {
        $this->service = $service;
    }

    public function index() {
        $empresas = $this->service->listarEmpresas();
        return view('admin.empresa.index', compact('empresas'));
    }

    public function show($id) {
        $empresa = $this->service->detalhesEmpresa($id);
        return view('admin.empresa.show', compact('empresa'));
    }

    public function create() {
        return view('admin.empresa.create');
    }

    public function store(Request $request) {
        $data = $request->validate([
            'nome' => 'required|string|max:255',
            'responsavel_legal' => 'required|string|max:255',
            'cnpj' => 'required|numeric',
        ]);

        $this->service->criarEmpresa($data);

        return redirect()->route('admin.empresa.index')->with('success', 'Empresa criada com sucesso!');
    }

    public function edit($id) {
        $empresa = $this->service->detalhesEmpresa($id);
        return view('admin.empresa.edit', compact('empresa'));
    }

    public function update(Request $request, $id) {
        $data = $request->validate([
            'nome' => 'required|string|max:255',
            'responsavel_legal' => 'required|string|max:255',
            'cnpj' => 'required|numeric',
        ]);

        $this->service->atualizarEmpresa($id, $data);
        return redirect()->route('admin.empresa.index')->with('success', 'Empresa atualizada com sucesso!');
    }

    public function destroy($id) {
        $this->service->excluirEmpresa($id);
        return redirect()->route('admin.empresa.index')->with('success', 'Empresa excluída com sucesso!');
    }
}
