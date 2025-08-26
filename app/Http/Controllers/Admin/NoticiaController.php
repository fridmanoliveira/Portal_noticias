<?php

namespace App\Http\Controllers\Admin;

use App\Models\Banner;
use App\Models\Noticia;
use App\Http\Controllers\Controller;
use App\Http\Requests\NoticiaRequest; // Importe a NoticiaRequest
use App\Services\NoticiaService;      // Importe o NoticiaService
use Illuminate\Http\Request; // Manter, caso precise de alguma validação simples
use App\Services\CategoriaNoticiaService; // Para buscar categorias na criação/edição

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
    public function store(NoticiaRequest $request)
    {
        try {
            $this->noticiaService->store($request->validated());
            return redirect()->route('admin.noticias.index')->with('success', 'Notícia criada com sucesso!');
        } catch (\Exception $e) {
            return back()->with('error', 'Erro ao criar notícia: ' . $e->getMessage());
        }
    }

    /**
     * Exibe os detalhes de uma notícia específica.
     * @param \App\Models\Noticia $noticia O modelo da notícia, resolvido via Route Model Binding.
     */
    public function show(Noticia $noticia)
    {
        if (!$noticia->ativo) {
            abort(404);
        }

        $quantidadeDesejada = 5;

        $outrasNoticias = Noticia::where('ativo', true)
            ->where('categoria_id', $noticia->categoria_id)
            ->where('id', '!=', $noticia->id)
            ->latest('publicado_em')
            ->limit($quantidadeDesejada)
            ->get();

        $idsParaExcluir = $outrasNoticias->pluck('id')->push($noticia->id);

        // Se não encontrou a quantidade desejada, completa com as mais recentes de qualquer categoria
        if ($outrasNoticias->count() < $quantidadeDesejada) {
            $necessarias = $quantidadeDesejada - $outrasNoticias->count();

            $noticiasRecentes = Noticia::where('ativo', true)
                ->whereNotIn('id', $idsParaExcluir)
                ->latest('publicado_em')
                ->limit($necessarias)
                ->get();

            $outrasNoticias = $outrasNoticias->concat($noticiasRecentes);
        }

        return view('site.noticias.show', compact('noticia', 'outrasNoticias'));
    }

    public function edit(Noticia $noticia)
    {
        $categorias = $this->categoriaNoticiaService->all();
        return view('admin.noticias.edit', compact('noticia', 'categorias'));
    }

    public function update(NoticiaRequest $request, Noticia $noticia)
    {
        $this->noticiaService->update($noticia->id, $request->validated());
        return redirect()->route('admin.noticias.index')->with('success', 'Notícia atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Noticia $noticia)
    {
        $this->noticiaService->delete($noticia->id);
        return redirect()->route('admin.noticias.index')->with('success', 'Notícia excluída com sucesso!');
    }

    /**
     * Exibe a lista de todas as notícias ativas para o público, com opções de filtro.
     */
    public function noticias(Request $request)
    {
        // ... (seu método index permanece inalterado)
        $query = \App\Models\Noticia::where('ativo', true);

        if ($request->filled('categoria_id') && $request->categoria_id != '') {
            $query->where('categoria_id', $request->categoria_id);
        }

        if ($request->filled('descricao')) {
            $descricao = $request->input('descricao');
            $query->where(function ($q) use ($descricao) {
                $q->where('titulo', 'like', '%' . $descricao . '%')
                  ->orWhere('resumo', 'like', '%' . $descricao . '%');
            });
        }

        if ($request->filled('periodo_inicio')) {
            $query->where('publicado_em', '>=', $request->periodo_inicio);
        }
        if ($request->filled('periodo_fim')) {
            $query->where('publicado_em', '<=', $request->periodo_fim . ' 23:59:59');
        }

        $noticias = $query->orderByDesc('publicado_em')->paginate(9)->withQueryString();
        $categorias = $this->categoriaNoticiaService->all();
        $bannerPrincipal = Banner::where('ativo', true)->first();

        return view('site.noticias.index', compact('noticias', 'categorias', 'bannerPrincipal'));
    }
}
