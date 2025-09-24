<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use App\Models\Productos;
use App\Models\Categorias;
use App\Models\Almacenes;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;

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
        // Forzar HTTPS en producción (Render.com)
        if (app()->environment('production')) {
            URL::forceScheme('https');
        }
        
        // Para Render.com: confiar en proxy headers
        if (app()->environment('production')) {
            $this->app['request']->server->set('HTTPS', 'on');
        }
    }
}
