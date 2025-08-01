<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoriaNoticiaRequest; // Importe a CategoriaNoticiaRequest
use App\Services\CategoriaNoticiaService;      // Importe o CategoriaNoticiaService
use Illuminate\Http\Request; // Manter, caso precise de alguma validação simples

class CategoriaNoticiaController extends Controller
{
    protected CategoriaNoticiaService $categoriaNoticiaService;

    public function __construct(CategoriaNoticiaService $categoriaNoticiaService)
    {
        $this->categoriaNoticiaService = $categoriaNoticiaService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categorias = $this->categoriaNoticiaService->getAllForAdmin();
        return view('admin.categorias_noticias.index', compact('categorias'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categorias_noticias.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoriaNoticiaRequest $request) // Use CategoriaNoticiaRequest
    {
        $this->categoriaNoticiaService->store($request->validated());

        return redirect()->route('admin.categorias-noticias.index')->with('success', 'Categoria de notícia criada com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $categoria = $this->categoriaNoticiaService->find($id);
        return view('admin.categorias_noticias.show', compact('categoria')); // Crie esta view se precisar
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $categoria = $this->categoriaNoticiaService->find($id);
        return view('admin.categorias_noticias.edit', compact('categoria'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoriaNoticiaRequest $request, int $id) // Use CategoriaNoticiaRequest
    {
        $this->categoriaNoticiaService->update($id, $request->validated());

        return redirect()->route('admin.categorias-noticias.index')->with('success', 'Categoria de notícia atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $this->categoriaNoticiaService->delete($id);
        return redirect()->route('admin.categorias-noticias.index')->with('success', 'Categoria de notícia excluída com sucesso!');
    }
}
