<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Site\HomeController;
use App\Http\Controllers\Site\NoticiaController;  
use App\Http\Controllers\Admin\NoticiaController as AdminNoticiaController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\VideoHomeController;
use App\Http\Controllers\Admin\AcessoRapidoController;
use App\Http\Controllers\Admin\BannerRotativoController;
use App\Http\Controllers\Admin\CategoriaNoticiaController;


// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [HomeController::class, 'index'])->name('site.home');
Route::get('/noticias', [NoticiaController::class, 'index'])->name('site.noticias.index');
Route::get('/noticias/{noticia}', [NoticiaController::class, 'show'])->name('site.noticias.show');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('admin')
    ->name('admin.') // Prefixo de nome das rotas
    ->middleware(['auth', 'verified'])
    ->group(function () {

        Route::get('', [HomeController::class, 'dashboard'])
            ->name('dashboard');

        // Banners (Controller já existente)
        Route::get('banners', [BannerController::class, 'index'])->name('banners.index');
        Route::get('banners/create', [BannerController::class, 'create'])->name('banners.create');
        Route::post('banners', [BannerController::class, 'store'])->name('banners.store');
        Route::get('banners/{banner}/edit', [BannerController::class, 'edit'])->name('banners.edit');
        Route::put('banners/{banner}', [BannerController::class, 'update'])->name('banners.update');
        Route::delete('banners/{banner}', [BannerController::class, 'destroy'])->name('banners.destroy');

        // Banners Rotativo
        Route::get('banners-rotativo', [BannerRotativoController::class, 'index'])->name('banners-rotativo.index');
        Route::get('banners-rotativo/create', [BannerRotativoController::class, 'create'])->name('banners-rotativo.create');
        Route::post('banners-rotativo', [BannerRotativoController::class, 'store'])->name('banners-rotativo.store');
        Route::get('banners-rotativo/{bannerRotativo}/edit', [BannerRotativoController::class, 'edit'])->name('banners-rotativo.edit');
        Route::put('banners-rotativo/{bannerRotativo}', [BannerRotativoController::class, 'update'])->name('banners-rotativo.update');
        Route::delete('banners-rotativo/{bannerRotativo}', [BannerRotativoController::class, 'destroy'])->name('banners-rotativo.destroy');

        // Acessos Rápidos
        Route::get('acessos-rapidos', [AcessoRapidoController::class, 'index'])->name('acessos-rapidos.index');
        Route::get('acessos-rapidos/create', [AcessoRapidoController::class, 'create'])->name('acessos-rapidos.create');
        Route::post('acessos-rapidos', [AcessoRapidoController::class, 'store'])->name('acessos-rapidos.store');
        Route::get('acessos-rapidos/{acessoRapido}/edit', [AcessoRapidoController::class, 'edit'])->name('acessos-rapidos.edit');
        Route::put('acessos-rapidos/{acessoRapido}', [AcessoRapidoController::class, 'update'])->name('acessos-rapidos.update');
        Route::delete('acessos-rapidos/{acessoRapido}', [AcessoRapidoController::class, 'destroy'])->name('acessos-rapidos.destroy');

        // Notícias (AGORA USANDO O ALIAS CORRETO)
        Route::get('noticias', [AdminNoticiaController::class, 'index'])->name('noticias.index');
        Route::get('noticias/create', [AdminNoticiaController::class, 'create'])->name('noticias.create');
        Route::post('noticias', [AdminNoticiaController::class, 'store'])->name('noticias.store');
        Route::get('noticias/{noticia}', [AdminNoticiaController::class, 'show'])->name('noticias.show');
        Route::get('noticias/{noticia}/edit', [AdminNoticiaController::class, 'edit'])->name('noticias.edit');
        Route::put('noticias/{noticia}', [AdminNoticiaController::class, 'update'])->name('noticias.update');
        Route::delete('noticias/{noticia}', [AdminNoticiaController::class, 'destroy'])->name('noticias.destroy');

        // Categorias de Notícias (Controller já existente)
        Route::get('categorias-noticias', [CategoriaNoticiaController::class, 'index'])->name('categorias-noticias.index');
        Route::get('categorias-noticias/create', [CategoriaNoticiaController::class, 'create'])->name('categorias-noticias.create');
        Route::post('categorias-noticias', [CategoriaNoticiaController::class, 'store'])->name('categorias-noticias.store');
        Route::get('categorias-noticias/{categoriaNoticia}', [CategoriaNoticiaController::class, 'show'])->name('categorias-noticias.show');
        Route::get('categorias-noticias/{categoriaNoticia}/edit', [CategoriaNoticiaController::class, 'edit'])->name('categorias-noticias.edit');
        Route::put('categorias-noticias/{categoriaNoticia}', [CategoriaNoticiaController::class, 'update'])->name('categorias-noticias.update');
        Route::delete('categorias-noticias/{categoriaNoticia}', [CategoriaNoticiaController::class, 'destroy'])->name('categorias-noticias.destroy');

        // Vídeos
        Route::get('videos', [VideoHomeController::class, 'index'])->name('videos.index');
        Route::get('videos/create', [VideoHomeController::class, 'create'])->name('videos.create');
        Route::post('videos', [VideoHomeController::class, 'store'])->name('videos.store');
        Route::get('videos/{video}', [VideoHomeController::class, 'show'])->name('videos.show');
        Route::get('videos/{video}/edit', [VideoHomeController::class, 'edit'])->name('videos.edit');
        Route::put('videos/{video}', [VideoHomeController::class, 'update'])->name('videos.update');
        Route::delete('videos/{video}', [VideoHomeController::class, 'destroy'])->name('videos.destroy');
});


require __DIR__.'/auth.php';
