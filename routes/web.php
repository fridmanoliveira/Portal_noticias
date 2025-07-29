<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Site\HomeController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\AcessoRapidoController;
use App\Http\Controllers\Admin\BannerRotativoController;
use App\Http\Controllers\Admin\CategoriaNoticiaController;
use App\Http\Controllers\Admin\NoticiaController;


// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [HomeController::class, 'index'])->name('site.home');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('admin')
    ->name('admin.') // aqui define o prefixo de nome das rotas
    ->middleware(['auth', 'verified'])
    ->group(function () {
        Route::resource('banners', BannerController::class)
            ->except(['show']);
        Route::resource('banners-rotativo', BannerRotativoController::class)
            ->except(['show']);

        Route::resource('acessos-rapidos', AcessoRapidoController::class)->names('acessos-rapidos');

        Route::resource('noticias', NoticiaController::class); // Todas as operações de CRUD para notícias

        Route::resource('categorias-noticias', CategoriaNoticiaController::class)->names('categorias-noticias');
    });



require __DIR__.'/auth.php';
