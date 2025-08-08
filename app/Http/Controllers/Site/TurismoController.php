<?php

namespace App\Http\Controllers\Site;

use App\Models\Banner;
use App\Models\Noticia;
use App\Models\Turismo;
use App\Http\Controllers\Controller;

class TurismoController extends Controller
{
    public function index()
    {
        $turismo = Turismo::where('ativo', true)->latest()->first();
        $bannerPrincipal = Banner::where('ativo', true)->first();

        // Pega as últimas 4 notícias para mostrar na sidebar
        $noticiasRelacionadas = Noticia::where('ativo', true)->latest()->take(4)->get();

        return view('site.turismo', compact('turismo', 'bannerPrincipal', 'noticiasRelacionadas'));
    }
}
