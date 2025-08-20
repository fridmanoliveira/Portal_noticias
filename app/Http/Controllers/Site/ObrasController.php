<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Obra;
use Illuminate\Http\Request;

class ObrasController extends Controller
{
    public function index(Request $request)
    {
        // Valores padrão para os filtros
        $filtros = [
            'ano'       => $request->input('ano', 'Todos'),
            'status'    => $request->input('status', 'Todos os status'),
            'search'    => $request->input('search', ''),
        ];

        // Query base com eager loading
        $query = Obra::with(['empresa', 'fiscal', 'imagens'])
            ->orderBy('data_inicio', 'desc');

        // Aplicar filtros dinamicamente
        if ($filtros['ano'] !== 'Todos') {
            $query->whereYear('data_inicio', $filtros['ano']);
        }

        if ($filtros['status'] !== 'Todos os status') {
            $query->where('situacao', $filtros['status']);
        }

        if (!empty($filtros['search'])) {
            $query->where(function($q) use ($filtros) {
                $q->where('descricao', 'like', '%'.$filtros['search'].'%')
                  ->orWhereHas('empresa', function($q) use ($filtros) {
                      $q->where('nome', 'like', '%'.$filtros['search'].'%');
                  });
            });
        }

        // Obter listas para filtros
        $anosDisponiveis = Obra::selectRaw('YEAR(data_inicio) as ano')
            ->distinct()
            ->orderByDesc('ano')
            ->pluck('ano');

        $statusDisponiveis = Obra::select('situacao')
            ->whereNotNull('situacao')
            ->distinct()
            ->orderBy('situacao')
            ->pluck('situacao');

        // Paginação
        $obras = $query->paginate(10)->withQueryString();

        return view('site.obras.index', compact(
            'obras',
            'filtros',
            'anosDisponiveis',
            'statusDisponiveis'
        ));
    }

    public function show($id)
    {
        $obra = Obra::with(['empresa', 'fiscal', 'imagens'])
            ->findOrFail($id);

        // Aqui você pode substituir a galeria fake por $obra->imagens
        $galeria = $obra->imagens->map(function ($img) {
            return [
                'url'     => asset($img->image_path),
                'legenda' => $img->legenda ?? 'Imagem da obra'
            ];
        });

        return view('site.obras.show', compact('obra', 'galeria'));
    }
}
