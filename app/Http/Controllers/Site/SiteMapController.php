<?php

namespace App\Http\Controllers\Site;

use App\Models\Obra;
use App\Models\Noticia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SiteMapController extends Controller
{
    public function index()
    {
        $noticias = Noticia::latest()->get();
        $obras = Obra::latest()->get();

        return view('site.sitemap', compact('noticias', 'obras'));
    }
}
