<?php
namespace App\Http\Controllers\Site;

use App\Models\Logo;
use App\Models\Banner;
use App\Models\Noticia;
use App\Models\VideoHome;
use App\Models\RedeSocial;
use App\Models\AcessoRapido;
use App\Http\Controllers\Controller;
use App\Models\BannerRotativo;

class HomeController extends Controller
{
    public function index()
    {
        $logo = Logo::first(); // Exibir a principal
        $redesSociais = RedeSocial::where('ativo', true)->get();
        $bannerPrincipal = Banner::where('ativo', true)->first();
        $bannerCarrossel = BannerRotativo::where('ativo', true)->orderBy('ordem')->get();
        $noticias = Noticia::where('ativo', true)->latest()->take(3)->get();
        $acessosRapidos = AcessoRapido::where('ativo', true)->orderBy('ordem')->get();
        $video = VideoHome::where('ativo', true)->latest()->first();

        return view('site.home', compact(
            'logo',
            'redesSociais',
            'bannerPrincipal',
            'bannerCarrossel',
            'noticias',
            'acessosRapidos',
            'video'
        ));
    }
}
