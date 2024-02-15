<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
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
       //
    }
}
