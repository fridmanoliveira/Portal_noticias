<?php

namespace App\Http\Controllers\Admin;

use App\Models\Banner;
use App\Models\Noticia;
use App\Http\Controllers\Controller;
use App\Http\Requests\NoticiaRequest;
use App\Services\NoticiaService;
use Illuminate\Http\Request;
use App\Services\CategoriaNoticiaService;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class NoticiaController extends Controller
{
    protected NoticiaService $noticiaService;
    protected CategoriaNoticiaService $categoriaNoticiaService;

    public function __construct(NoticiaService $noticiaService, CategoriaNoticiaService $categoriaNoticiaService)
    {
        $this->noticiaService = $noticiaService;
        $this->categoriaNoticiaService = $categoriaNoticiaService;
    }

    public function index()
    {
        $noticias = $this->noticiaService->getAllForAdmin();
        return view('admin.noticias.index', compact('noticias'));
    }

    public function create()
    {
        $categorias = $this->categoriaNoticiaService->all();
        return view('admin.noticias.create', compact('categorias'));
    }

    public function store(NoticiaRequest $request)
    {
        try {
            $this->noticiaService->store($request->validated());
            return redirect()->route('admin.noticias.index')->with('success', 'Notícia criada com sucesso!');
        } catch (\Exception $e) {
            return back()->with('error', 'Erro ao criar notícia: ' . $e->getMessage());
        }
    }

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

    public function destroy(Noticia $noticia)
    {
        $this->noticiaService->delete($noticia->id);
        return redirect()->route('admin.noticias.index')->with('success', 'Notícia excluída com sucesso!');
    }

    public function noticias(Request $request)
    {
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

    /**
     * Realiza o upload de imagens do CKEditor.
     */
    public function uploadImage(Request $request)
    {
        if ($request->hasFile('upload')) {
            $validator = Validator::make($request->all(), [
                'upload' => 'required|image|mimes:jpeg,png,jpg,webp|max:5120',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'error' => [
                        'message' => 'Arquivo inválido: ' . $validator->errors()->first('upload')
                    ]
                ], 422);
            }

            try {
                $file = $request->file('upload');
                $extension = $file->getClientOriginalExtension();
                $fileName = time() . '_' . Str::random(10) . '.' . $extension;
                
                $destinationPath = public_path('uploads/noticias');
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0755, true);
                }

                $file->move($destinationPath, $fileName);
                $url = asset('uploads/noticias/' . $fileName);

                return response()->json(['url' => $url]);
            } catch (\Exception $e) {
                return response()->json([
                    'error' => [
                        'message' => 'Erro ao salvar a imagem no servidor.'
                    ]
                ], 500);
            }
        }

        return response()->json(['error' => ['message' => 'Nenhum arquivo enviado.']], 400);
    }
}
