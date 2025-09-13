<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\PPAController;
use App\Http\Controllers\Site\HomeController;
use App\Http\Controllers\Admin\ObraController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Site\MapaController;
use App\Http\Controllers\Site\ObrasController;
use App\Http\Controllers\Site\SearchController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\FiscalController;
use App\Http\Controllers\Site\TurismoController;
use App\Http\Controllers\Admin\EmpresaController;
use App\Http\Controllers\Admin\NoticiaController;
use App\Http\Controllers\Site\HistoriaController;
use App\Http\Controllers\Admin\VideoHomeController;
use App\Http\Controllers\Admin\PpaSettingsController;
use App\Http\Controllers\Admin\AcessoRapidoController;
use App\Http\Controllers\Admin\AdminTurismoController;
use App\Http\Controllers\Admin\AdminMapaController;
use App\Http\Controllers\Admin\AdminQuestionController;
use App\Http\Controllers\Admin\AndamentoObraController;
use App\Http\Controllers\Admin\BannerRotativoController;
use App\Http\Controllers\Admin\CategoriaNoticiaController;
use App\Http\Controllers\Site\SiteMapController;

Route::get('/buscar', [SearchController::class, 'index'])->name('site.buscar');

Route::get('/mapa-do-site', [SiteMapController::class, 'index'])->name('site.sitemap');
Route::view('/politicas-privacidade', 'site.politicas')->name('politicas-privacidade');
Route::get('/manual-da-marca', function () {
    return view('site.Marca.marca');
})->name('marca');


// Site
Route::get('/', [HomeController::class, 'index'])->name('site.home');
Route::get('/noticias', [NoticiaController::class, 'noticias'])->name('site.noticias.index');
Route::get('/noticias/{noticia}', [NoticiaController::class, 'show'])->name('site.noticias.show');
Route::get('/historia-da-cidade', [HistoriaController::class, 'index'])->name('site.historia');
Route::get('/turismos', [TurismoController::class, 'index'])->name('site.turismo');
Route::get('/mapas-da-cidade', [MapaController::class, 'index'])->name('site.mapas');

// Obras do site
Route::get('/obras-andamento', [ObrasController::class, 'index'])->name('obras.index');
Route::get('/obras-andamento/{obra}', [ObrasController::class, 'show'])->name('obras.show');

// PPA
Route::prefix('ppa-participativo')->group(function () {
    Route::get('/', [PPAController::class, 'showForm'])->name('ppa.form');
    Route::post('/', [PPAController::class, 'submitForm'])->name('ppa.submit');
    Route::get('obrigado/{id}', [PPAController::class, 'showThanks'])->name('ppa.thanks');
});

// Profile
Route::middleware('auth')->prefix('profile')->group(function () {
    Route::get('/', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('admin')
    ->middleware(['auth','verified'])
    ->name('admin.')
    ->group(function(){

    Route::resource('users', UserController::class)->middleware('role_or_permission:master');

    Route::get('/', [HomeController::class,'dashboard'])->name('dashboard');

    // Conteúdo
    Route::middleware('permission:gerenciar conteudo')->group(function(){
        Route::resource('banners', BannerController::class);
        Route::resource('banners-rotativo', BannerRotativoController::class);
        Route::resource('acessos-rapidos', AcessoRapidoController::class);
        Route::resource('noticias', NoticiaController::class);
        Route::resource('categorias-noticias', CategoriaNoticiaController::class);
        Route::resource('videos', VideoHomeController::class);
        Route::resource('turismo', AdminTurismoController::class);
        Route::resource('mapas', AdminMapaController::class); // <-- Adicionar esta linha

    });

    // PPA
    Route::prefix('ppa-participativo')
        ->middleware('permission:gerenciar ppa')
        ->group(function(){
            Route::get('/', [PPAController::class,'dashboard'])->name('ppa.dashboard');
            Route::get('/configuracoes',[PpaSettingsController::class,'edit'])->name('ppa.settings');
            Route::put('/configuracoes',[PpaSettingsController::class,'update'])->name('ppa.fechado.update');

            Route::resources([
                'questions' => AdminQuestionController::class,
            ]);
        });

    // Obras
    Route::middleware('permission:gerenciar obras')->group(function(){
        Route::resource('obras', ObraController::class)->except(['show']);
        Route::resources([
            'empresas' => EmpresaController::class,
            'fiscais'  => FiscalController::class,
        ]);

        Route::prefix('obras/{obra}/andamentos')->name('obras.andamentos.')->group(function(){
            Route::get('/', [AndamentoObraController::class,'porObra'])->name('index');
            Route::get('/create', [AndamentoObraController::class,'create'])->name('create');
            Route::post('/', [AndamentoObraController::class,'store'])->name('store');
        });

        Route::prefix('andamento')->name('andamento.')->group(function(){
            Route::get('{andamento}', [AndamentoObraController::class,'show'])->name('show');
            Route::get('{andamento}/edit', [AndamentoObraController::class,'edit'])->name('edit');
            Route::put('{andamento}', [AndamentoObraController::class,'update'])->name('update');
            Route::delete('{andamento}', [AndamentoObraController::class,'destroy'])->name('destroy');
        });
    });

});

require __DIR__.'/auth.php';
