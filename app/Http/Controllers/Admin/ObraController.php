<?php

namespace App\Http\Controllers\admin;

use App\Models\Fiscal;
use App\Models\Empresa;
use Illuminate\Http\Request;
use App\Services\ObraService;
use App\Http\Controllers\Controller;

class ObraController extends Controller
{
    protected $service;

    public function __construct(ObraService $service) {
        $this->service = $service;
    }

    public function index() {
        $obras = $this->service->listarObras();
        return view('admin.obras.index', compact('obras'));
    }

    public function show($id) {
        $obra = $this->service->detalhesObra($id);
        return view('admin.obras.show', compact('obra'));
    }

    public function create() {
        $empresas = Empresa::all();
        $fiscais = Fiscal::all();
        return view('admin.obras.create', compact('empresas', 'fiscais'));
    }

    public function store(Request $request) {
        $data = $request->validate([
            'descricao' => 'required|string|max:255',
            'fonte_recurso' => 'nullable|string|max:255',
            'data_inicio' => 'required|date',
            'data_conclusao' => 'nullable|date',
            'situacao' => 'required|string|max:50',
            'etapa_atual' => 'required|string|max:255',
            'valor' => 'required|numeric|min:0',
            'valor_aditado' => 'nullable|numeric|min:0',
            'prazo_aditado' => 'nullable|numeric|min:0',
            'empresa_id' => 'required|exists:empresas,id',
            'fiscal_id' => 'required|exists:fiscais,id',
            'imagens.*' => 'nullable|image|max:20048',
            'remover_imagens' => 'nullable|array',
            'remover_imagens.*' => 'integer|exists:galeria_images_turismo,id',
        ]);

        $this->service->criarObra($data);

        return redirect()->route('admin.obras.index')->with('success', 'Obra criada com sucesso!');
    }

    public function edit($id) {
        $obra = $this->service->detalhesObra($id);
        $empresas = Empresa::all();
        $fiscais = Fiscal::all();
        return view('admin.obras.edit', compact('obra', 'empresas', 'fiscais'));
    }

    public function update(Request $request, $id) {
        $data = $request->validate([
            'descricao' => 'required|string|max:255',
            'fonte_recurso' => 'nullable|string|max:255',
            'data_inicio' => 'required|date',
            'data_conclusao' => 'nullable|date',
            'situacao' => 'required|string|max:50',
            'etapa_atual' => 'required|string|max:255',
            'valor' => 'required|numeric|min:0',
            'valor_aditado' => 'nullable|numeric|min:0',
            'prazo_aditado' => 'nullable|int|min:0',
            'fiscal_id' => 'required|exists:fiscais,id',
            'imagens.*' => 'nullable|image|max:20048',
            'remover_imagens' => 'nullable|array',
            'remover_imagens.*' => 'integer|exists:imagem_obras,id',
            'latitude'  => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
        ]);

        $this->service->atualizarObra($id, $data);
        return redirect()->route('admin.obras.index')->with('success', 'Obra atualizada com sucesso!');
    }

    public function destroy($id) {
        $this->service->excluirObra($id);
        return redirect()->route('admin.obras.index')->with('success', 'Obra excluída com sucesso!');
    }
}
