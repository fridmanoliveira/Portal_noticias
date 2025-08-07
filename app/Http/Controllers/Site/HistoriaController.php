<?php
namespace App\Http\Controllers\Site;

use App\Models\Banner;
use App\Models\Noticia;
use App\Models\VideoHome;
use App\Http\Controllers\Controller;

class HistoriaController extends Controller
{
    public function index()
    {
        $video = VideoHome::where('ativo', true)->latest()->first();
        $bannerPrincipal = Banner::where('ativo', true)->first();

        // Pega as últimas 3 notícias para mostrar na sidebar
        $noticiasRelacionadas = Noticia::where('ativo', true)->latest()->take(4)->get();

        return view('site.historia', compact('video', 'bannerPrincipal', 'noticiasRelacionadas'));
    }
}
