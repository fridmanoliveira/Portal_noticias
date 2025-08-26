<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Noticia;
use App\Models\Turismo;
use App\Models\AcessoRapido;
use App\Models\Banner;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('q');

        $resultados = collect();

        if ($query) {
            // Notícias
            $noticias = Noticia::where('titulo', 'LIKE', "%{$query}%")
                ->orWhere('conteudo', 'LIKE', "%{$query}%")
                ->get()
                ->map(function ($item) {
                    return [
                        'tipo' => 'noticia',
                        'titulo' => $item->titulo,
                        'conteudo' => $item->conteudo,
                        'url' => route('site.noticias.show', $item->slug),
                        'created_at' => $item->created_at,
                    ];
                });


            $resultados = $noticias
                ->sortByDesc('created_at');
        }

        // 🔹 Paginação manual (porque juntamos collections)
        $perPage = 10;
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $items = $resultados instanceof Collection ? $resultados : Collection::make($resultados);
        $paged = new LengthAwarePaginator(
            $items->forPage($currentPage, $perPage),
            $items->count(),
            $perPage,
            $currentPage,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        return view('site.buscar', [
            'resultados' => $paged,
            'query' => $query,
        ]);
    }
}
