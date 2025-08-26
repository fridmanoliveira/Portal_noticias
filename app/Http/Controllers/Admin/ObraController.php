<?php

namespace App\Http\Controllers\Admin;

use App\Models\Fiscal;
use App\Models\Empresa;
use App\Models\Obra;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Services\ObraService;
use App\Http\Controllers\Controller;

class ObraController extends Controller
{
    protected ObraService $service;

    public function __construct(ObraService $service)
    {
        $this->service = $service;
    }

    // Lista todas as obras
    public function index(Request $request)
    {
        // Inicia a query do modelo Obra
        $query = Obra::with(['empresa', 'fiscal'])
            ->with(['andamentos' => function ($query) {
                $query->orderBy('created_at', 'desc')->limit(1);
            }])
            ->orderBy('id', 'desc');

        // Aplica o filtro de busca se houver
        if ($request->filled('search')) {
            $searchTerm = '%' . $request->search . '%';
            $query->where('descricao', 'like', $searchTerm)
                  ->orWhere('situacao', 'like', $searchTerm)
                  ->orWhereHas('empresa', function ($q) use ($searchTerm) {
                      $q->where('nome', 'like', $searchTerm);
                  });
        }

        // Paginação
        $obras = $query->paginate(10);

        return view('admin.obras.index', compact('obras'));
    }

    // Mostra detalhes de uma obra específica usando Route Model Binding
    public function show(Obra $obra)
    {
        $obra = $this->service->detalhesObra($obra);
        return view('admin.obras.show', compact('obra'));
    }

    // Formulário para criar uma nova obra
    public function create()
    {
        $empresas = Empresa::orderBy('nome')->get();
        $fiscais  = Fiscal::orderBy('nome')->get();
        return view('admin.obras.create', compact('empresas', 'fiscais'));
    }

    // Armazena nova obra
    public function store(Request $request)
    {
        $data = $this->validateData($request);

        $this->service->criarObra($data, $request);

        return redirect()
            ->route('admin.obras.index')
            ->with('success', 'Obra criada com sucesso!');
    }

    // Formulário para editar uma obra existente
    public function edit(Obra $obra)
    {
        $obra     = $this->service->detalhesObra($obra);
        $empresas = Empresa::orderBy('nome')->get();
        $fiscais  = Fiscal::orderBy('nome')->get();
        return view('admin.obras.edit', compact('obra', 'empresas', 'fiscais'));
    }

    // Atualiza uma obra existente
    public function update(Request $request, Obra $obra)
    {
        $data = $this->validateData($request, $obra);

        $this->service->atualizarObra($obra, $data, $request);

        return redirect()
            ->route('admin.obras.index')
            ->with('success', 'Obra atualizada com sucesso!');
    }

    // Exclui uma obra
    public function destroy(Obra $obra)
    {
        $this->service->excluirObra($obra);

        return redirect()
            ->route('admin.obras.index')
            ->with('success', 'Obra excluída com sucesso!');
    }

    // Validação centralizada
    protected function validateData(Request $request, Obra $obra = null): array
    {
        $slugRule = ['nullable','string','max:255'];
        if ($obra) {
            $slugRule[] = Rule::unique('obras','slug')->ignore($obra->id);
        } else {
            $slugRule[] = 'unique:obras,slug';
        }

        return $request->validate([
            'descricao'       => ['required','string','max:255'],
            'slug'            => $slugRule,
            'fonte_recurso'   => ['nullable','string','max:255'],
            'data_inicio'     => ['required','date'],
            'data_conclusao'  => ['nullable','date','after_or_equal:data_inicio'],
            'situacao'        => ['required','string','max:50'],
            'valor'           => ['required','numeric','min:0'],
            'valor_aditado'   => ['nullable','numeric','min:0'],
            'prazo_aditado'   => ['nullable','integer','min:0'],
            'empresa_id'      => ['required','exists:empresas,id'],
            'fiscal_id'       => ['required','exists:fiscais,id'],
            'latitude'        => ['nullable','numeric','between:-90,90'],
            'longitude'       => ['nullable','numeric','between:-180,180'],
            'imagens'         => ['nullable','array'],
            'imagens.*'       => ['image','max:20480'], // 20MB
            'remover_imagens'   => ['nullable','array'],
            'remover_imagens.*' => ['integer','exists:imagem_obras,id'],
        ]);
    }
}
