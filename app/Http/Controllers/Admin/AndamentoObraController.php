<?php

namespace App\Http\Controllers\Admin;

use App\Models\Obra;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\AndamentoObraService;
use App\Http\Requests\AndamentoObraRequest;

class AndamentoObraController extends Controller
{
    protected AndamentoObraService $andamentoObraService;

    public function __construct(AndamentoObraService $andamentoObraService)
    {
        $this->andamentoObraService = $andamentoObraService;
    }

    public function index(Obra $obra)
    {
        dd($obra);
        $andamentos = $obra->andamentos()->orderBy('data', 'desc')->paginate(10);

        return view('admin.obras.andamento.index', compact('andamentos'));
    }


    public function create(Obra $obra)
    {
        return view('admin.obras.andamento.create', compact('obra'));
    }

    public function store(AndamentoObraRequest $request, Obra $obra)
    {
        $data = $request->validated();
        $data['obra_id'] = $obra->id;

        $this->andamentoObraService->store($data);

        return redirect()
            ->route('admin.obras.andamentos.index', $obra->id)
            ->with('success', 'Andamento criado com sucesso.');
    }

    public function edit(int $id)
    {
        $andamento = $this->andamentoObraService->find($id);
        $obra = $andamento->obra;

        return view('admin.obras.andamento.edit', compact('andamento', 'obra'));
    }

    public function update(AndamentoObraRequest $request, int $id)
    {
        // Primeiro, encontra o andamento
        $andamento = $this->andamentoObraService->find($id);

        // Depois, atualiza o andamento
        $this->andamentoObraService->update($id, $request->validated());

        // Redireciona usando a obra do andamento
        return redirect()
            ->route('admin.obras.andamentos.index', $andamento->obra)
            ->with('success', 'Andamento atualizado com sucesso.');
    }

    public function destroy(int $id)
    {
        // Encontra o andamento antes de deletar para obter a obra
        $andamento = $this->andamentoObraService->find($id);
        $obra = $andamento->obra; // Salva a obra antes de deletar o andamento

        // Deleta o andamento
        $this->andamentoObraService->delete($id);

        // Redireciona usando o objeto obra que foi salvo
        return redirect()
            ->route('admin.obras.andamentos.index', $obra)
            ->with('success', 'Andamento excluído com sucesso.');
    }

    public function porObra(Obra $obra)
    {
        $andamentos = $obra->andamentos()->orderBy('data', 'desc')->paginate(10);
        // dd($andamentos);
        return view('admin.obras.andamento.index', compact('andamentos', 'obra'));
    }

}
