<?php

namespace App\Http\Controllers\Site;

use App\Models\Banner;
use App\Http\Controllers\Controller;
use App\Models\Mapa;
use App\Models\Noticia;

class MapaController extends Controller
{
    public function index()
    {
        $mapas = Mapa::where('ativo', true)->latest()->get();
        $bannerPrincipal = Banner::where('ativo', true)->first();

        $noticias = Noticia::where('ativo', true)
                        ->latest('publicado_em')
                        ->take(3)
                        ->get();

        return view('site.mapas', compact('mapas', 'bannerPrincipal', 'noticias'));
    }
}
