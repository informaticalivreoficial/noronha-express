<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

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
        $configuracoes = \App\Models\Config::find(1); 
        View()->share('configuracoes', $configuracoes);
        //Paginator::useBootstrap();
        Livewire::setScriptRoute(function ($handle) { return Route::get('/livewire/livewirejs', $handle); });
    }
}
