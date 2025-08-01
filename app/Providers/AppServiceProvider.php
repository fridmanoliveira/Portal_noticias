<?php

namespace App\Providers;

use App\Models\Noticia;
use Illuminate\Support\Facades\Route;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Route::bind('noticia', function ($value) {
        return Noticia::where('slug', $value)->where('ativo', true)->firstOrFail();
    });
    }
}
