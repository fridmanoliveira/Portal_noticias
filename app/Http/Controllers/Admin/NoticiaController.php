<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\NoticiaRequest; // Importe a NoticiaRequest
use App\Services\NoticiaService;      // Importe o NoticiaService
use App\Services\CategoriaNoticiaService; // Para buscar categorias na criação/edição
use Illuminate\Http\Request; // Manter, caso precise de alguma validação simples

class NoticiaController extends Controller
{
    protected NoticiaService $noticiaService;
    protected CategoriaNoticiaService $categoriaNoticiaService; // Injetar o serviço de categorias

    public function __construct(NoticiaService $noticiaService, CategoriaNoticiaService $categoriaNoticiaService)
    {
        $this->noticiaService = $noticiaService;
        $this->categoriaNoticiaService = $categoriaNoticiaService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $noticias = $this->noticiaService->getAllForAdmin();  
        return view('admin.noticias.index', compact('noticias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categorias = $this->categoriaNoticiaService->all(); // Passa as categorias para o formulário
        return view('admin.noticias.create', compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(NoticiaRequest $request) // Use NoticiaRequest para validação
    {
        $this->noticiaService->store($request->validated());

        return redirect()->route('admin.noticias.index')->with('success', 'Notícia criada com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $noticia = $this->noticiaService->find($id);
        return view('admin.noticias.show', compact('noticia')); // Crie esta view se precisar de uma página de detalhes
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $noticia = $this->noticiaService->find($id);
        $categorias = $this->categoriaNoticiaService->all(); // Passa as categorias para o formulário
        return view('admin.noticias.edit', compact('noticia', 'categorias'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(NoticiaRequest $request, int $id) // Use NoticiaRequest para validação
    {
        $this->noticiaService->update($id, $request->validated());

        return redirect()->route('admin.noticias.index')->with('success', 'Notícia atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $this->noticiaService->delete($id);
        return redirect()->route('admin.noticias.index')->with('success', 'Notícia excluída com sucesso!');
    }
}
