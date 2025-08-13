<?php

namespace App\Providers;

use App\Models\Noticia;
use Illuminate\Support\Facades\Route;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

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
            Route::model('banner', \App\Models\BannerRotativo::class);
        });

        Validator::extend('cpf', function ($attribute, $value, $parameters, $validator) {
            $cpf = preg_replace('/[^0-9]/', '', $value);

            if (strlen($cpf) != 11) {
                return false;
            }

            if (preg_match('/(\d)\1{10}/', $cpf)) {
                return false;
            }

            for ($t = 9; $t < 11; $t++) {
                for ($d = 0, $c = 0; $c < $t; $c++) {
                    $d += $cpf[$c] * (($t + 1) - $c);
                }
                $d = ((10 * $d) % 11) % 10;
                if ($cpf[$c] != $d) {
                    return false;
                }
            }

            return true;
        });
    }
}
