<?php

namespace App\Http\Controllers\Admin;

use App\Models\Obra;
use App\Models\Empresa;
use App\Models\Fiscal;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Services\ObraService;
use App\Http\Controllers\Controller;

class ObraController extends Controller
{
    public function __construct(protected ObraService $service) {}

    public function index(Request $request)
    {
        $query = Obra::with(['empresa', 'fiscal', 'andamentos' => fn($q) => $q->latest()->limit(1)])
            ->orderByDesc('id');

        if ($request->filled('search')) {
            $term = "%{$request->search}%";
            $query->where(fn($q) => $q->where('descricao', 'like', $term)
                ->orWhere('situacao', 'like', $term)
                ->orWhereHas('empresa', fn($q2) => $q2->where('nome', 'like', $term)));
        }

        $obras = $query->paginate(10);

        return view('admin.obras.index', compact('obras'));
    }

    public function show(Obra $obra)
    {
        $obra = $this->service->detalhesObra($obra);
        return view('admin.obras.show', compact('obra'));
    }

    public function create()
    {
        $empresas = Empresa::orderBy('nome')->get();
        $fiscais  = Fiscal::orderBy('nome')->get();
        return view('admin.obras.create', compact('empresas', 'fiscais'));
    }

    public function store(Request $request)
    {
        $data = $this->validateData($request);
        $this->service->criarObra($data, $request);
        return redirect()->route('admin.obras.index')->with('success', 'Obra criada com sucesso!');
    }

    public function edit(Obra $obra)
    {
        $obra = $this->service->detalhesObra($obra);
        $empresas = Empresa::orderBy('nome')->get();
        $fiscais  = Fiscal::orderBy('nome')->get();
        return view('admin.obras.edit', compact('obra', 'empresas', 'fiscais'));
    }

    public function update(Request $request, Obra $obra)
    {
        $data = $this->validateData($request, $obra);
        $this->service->atualizarObra($obra, $data, $request);
        return redirect()->route('admin.obras.index')->with('success', 'Obra atualizada com sucesso!');
    }

    public function destroy(Obra $obra)
    {
        $this->service->excluirObra($obra);
        return redirect()->route('admin.obras.index')->with('success', 'Obra excluída com sucesso!');
    }

    protected function validateData(Request $request, Obra $obra = null): array
    {
        $slugRule = ['nullable', 'string', 'max:255'];
        $slugRule[] = $obra ? Rule::unique('obras','slug')->ignore($obra->id) : 'unique:obras,slug';

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
            'imagens.*'       => ['image','max:20480'],
            'remover_imagens' => ['nullable','array'],
            'remover_imagens.*'=> ['integer','exists:imagem_obras,id'],
        ]);
    }
}
