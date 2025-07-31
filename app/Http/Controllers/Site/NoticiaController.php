<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Services\NoticiaService;
use App\Services\CategoriaNoticiaService;
use Illuminate\Http\Request;
use App\Models\Banner;
use App\Models\Noticia;

class NoticiaController extends Controller
{
    protected NoticiaService $noticiaService;
    protected CategoriaNoticiaService $categoriaNoticiaService;

    public function __construct(NoticiaService $noticiaService, CategoriaNoticiaService $categoriaNoticiaService)
    {
        $this->noticiaService = $noticiaService;
        $this->categoriaNoticiaService = $categoriaNoticiaService;
    }

    /**
     * Exibe a lista de todas as notícias ativas para o público, com opções de filtro.
     */
    public function index(Request $request)
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
        $logo = \App\Models\Logo::first();
        $redesSociais = \App\Models\RedeSocial::where('ativo', true)->get();
        $bannerPrincipal = Banner::where('ativo', true)->first();

        return view('site.noticias.index', compact('noticias', 'categorias', 'logo', 'redesSociais', 'bannerPrincipal'));
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

        $logo = \App\Models\Logo::first();
        $redesSociais = \App\Models\RedeSocial::where('ativo', true)->get();

        return view('site.noticias.show', compact('noticia', 'logo', 'redesSociais', 'outrasNoticias'));
    }
}
