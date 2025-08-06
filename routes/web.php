<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Site\HomeController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\NoticiaController;
use App\Http\Controllers\Admin\VideoHomeController;
use App\Http\Controllers\Admin\AcessoRapidoController;
use App\Http\Controllers\Admin\BannerRotativoController;
use App\Http\Controllers\Admin\CategoriaNoticiaController;


// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [HomeController::class, 'index'])->name('site.home');
Route::get('/noticias', [NoticiaController::class, 'noticias'])->name('site.noticias.index');
Route::get('/noticias/{noticia}', [NoticiaController::class, 'show'])->name('site.noticias.show');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'verified'])
    ->group(function () {

        // Dashboard
        Route::get('', [HomeController::class, 'dashboard'])->name('dashboard');

        // Banners
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
        Route::get('acessos-rapidos/{acessos_rapido}/edit', [AcessoRapidoController::class, 'edit'])->name('acessos-rapidos.edit');
        Route::put('acessos-rapidos/{acessos_rapido}', [AcessoRapidoController::class, 'update'])->name('acessos-rapidos.update');
        Route::delete('acessos-rapidos/{acessos_rapido}', [AcessoRapidoController::class, 'destroy'])->name('acessos-rapidos.destroy');

        // Notícias
        Route::get('noticias', [NoticiaController::class, 'index'])->name('noticias.index');
        Route::get('noticias/create', [NoticiaController::class, 'create'])->name('noticias.create');
        Route::post('noticias', [NoticiaController::class, 'store'])->name('noticias.store');
        Route::get('noticias/{noticia}', [NoticiaController::class, 'show'])->name('noticias.show');
        Route::get('noticias/{noticia}/edit', [NoticiaController::class, 'edit'])->name('noticias.edit');
        Route::put('noticias/{noticia}', [NoticiaController::class, 'update'])->name('noticias.update');
        Route::delete('noticias/{noticia}', [NoticiaController::class, 'destroy'])->name('noticias.destroy');

        // Categorias Notícias
        Route::get('categorias-noticias', [CategoriaNoticiaController::class, 'index'])->name('categorias-noticias.index');
        Route::get('categorias-noticias/create', [CategoriaNoticiaController::class, 'create'])->name('categorias-noticias.create');
        Route::post('categorias-noticias', [CategoriaNoticiaController::class, 'store'])->name('categorias-noticias.store');
        Route::get('categorias-noticias/{categoria_noticia}/edit', [CategoriaNoticiaController::class, 'edit'])->name('categorias-noticias.edit');
        Route::put('categorias-noticias/{categoria_noticia}', [CategoriaNoticiaController::class, 'update'])->name('categorias-noticias.update');
        Route::delete('categorias-noticias/{categoria_noticia}', [CategoriaNoticiaController::class, 'destroy'])->name('categorias-noticias.destroy');

        // Vídeos
        Route::get('videos', [VideoHomeController::class, 'index'])->name('videos.index');
        Route::get('videos/create', [VideoHomeController::class, 'create'])->name('videos.create');
        Route::post('videos', [VideoHomeController::class, 'store'])->name('videos.store');
        Route::get('videos/{video}/edit', [VideoHomeController::class, 'edit'])->name('videos.edit');
        Route::put('videos/{video}', [VideoHomeController::class, 'update'])->name('videos.update');
        Route::delete('videos/{video}', [VideoHomeController::class, 'destroy'])->name('videos.destroy');
});


require __DIR__.'/auth.php';
