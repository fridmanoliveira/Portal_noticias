<?php

namespace App\Http\Controllers;

use App\Services\FiscalService;
use Illuminate\Http\Request;

class FiscalController extends Controller
{
    protected $service;

    public function __construct(FiscalService $service) {
        $this->service = $service;
    }

    public function index() {
        $fiscais = $this->service->listarFiscais()->load('obra');
        return view('admin.fiscal.index', compact('fiscais'));
    }

    public function show($id) {
        $fiscal = $this->service->detalhesFiscal($id);
        return view('admin.fiscal.show', compact('fiscal'));
    }

    public function create() {
        return view('admin.fiscal.create');
    }

    public function store(Request $request) {
        $data = $request->validate([
            'nome' => 'required|string|max:255',
            'crea' => 'required|string|max:20',
            'cpf' => 'required|numeric',
        ]);

        $this->service->criarFiscal($data);

        return redirect()->route('admin.fiscal.index')->with('success', 'Fiscal criada com sucesso!');
    }

    public function edit($id) {
        $fiscal = $this->service->detalhesFiscal($id);
        return view('admin.fiscal.edit', compact('fiscal'));
    }

    public function update(Request $request, $id) {
        $data = $request->validate([
            'nome' => 'required|string|max:255',
            'crea' => 'required|string|max:20',
            'cpf' => 'required|numeric',
        ]);

        $this->service->atualizarFiscal($id, $data);
        return redirect()->route('admin.fiscal.index')->with('success', 'Fiscal atualizada com sucesso!');
    }

    public function destroy($id) {
        $this->service->excluirFiscal($id);
        return redirect()->route('admin.fiscal.index')->with('success', 'Fiscal excluída com sucesso!');
    }
}
