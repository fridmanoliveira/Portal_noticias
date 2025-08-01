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

// Rotas administrativas
Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'verified'])
    ->group(function () {

        // Dashboard
        Route::get('dashboard', [HomeController::class, 'dashboard'])->name('dashboard');

        // Resources
        Route::resource('banners', BannerController::class)->except(['show']);
        Route::resource('banners-rotativo', BannerRotativoController::class)->except(['show']);
        Route::resource('acessos-rapidos', AcessoRapidoController::class)->except(['show']);
        Route::resource('noticias', NoticiaController::class); // Resource completo
        Route::resource('categorias-noticias', CategoriaNoticiaController::class);
        Route::resource('videos', VideoHomeController::class);
});


require __DIR__.'/auth.php';
