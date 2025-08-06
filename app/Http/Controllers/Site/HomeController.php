<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\AcessoRapido;
use App\Models\Banner;
use App\Models\BannerRotativo;
use App\Models\Logo;
use App\Models\Noticia;
use App\Models\RedeSocial;
use App\Models\VideoHome;

class HomeController extends Controller
{
    public function index()
    {
        $logo = Logo::first();
        $redesSociais = RedeSocial::where('ativo', true)->get();
        $bannerPrincipal = Banner::where('ativo', true)->first();
        $bannerCarrossel = BannerRotativo::where('ativo', true)->orderBy('ordem')->get();
        $acessosRapidos = AcessoRapido::where('ativo', true)->orderBy('ordem')->get();
        $video = VideoHome::where('ativo', true)->latest()->first();
        $noticiasCarrossel = Noticia::where('ativo', true)->latest()->take(3)->get();
        $noticiasGrid = Noticia::where('ativo', true)->latest()->skip(4)->take(2)->get();

        return view('site.home', compact(
            'logo',
            'redesSociais',
            'bannerPrincipal',
            'bannerCarrossel',
            'noticiasCarrossel',
            'noticiasGrid',
            'acessosRapidos',
            'video'
        ));
    }

    public function dashboard()
    {
        return view('dashboard', [
            'ultimasNoticias' => Noticia::latest()->take(5)->get(),
            'totalNoticias' => Noticia::count(),
            'totalAcessosRapidos' => AcessoRapido::count(),
            'totalCategorias' => \App\Models\CategoriaNoticia::count(),
        ]);
    }
}
