<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Blade;
use App\Models\Productos;
use App\Models\Categorias;
use App\Models\Almacenes;
use App\Models\User;
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

        Blade::if('admin', fn () => Auth::check() && Auth::user()->isAdmin());
        Blade::if('operario', fn () => Auth::check() && Auth::user()->isOperario());
        Blade::if('role', fn (string $role) => Auth::check() && Auth::user()->hasRole($role));
    }
}
