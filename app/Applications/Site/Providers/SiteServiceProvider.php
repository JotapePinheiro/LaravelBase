<?php

namespace App\Applications\Site\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class SiteServiceProvider extends ServiceProvider
{

    protected $namespace = 'App\Applications\Site\Http\Controllers';

    public function boot()
    {
        //

        parent::boot();

        $this->loadViewsFrom(__DIR__.'/../resources/views','site');

        View::composer('site::layouts.app', 'App\Applications\Site\Http\ViewComposers\ThemeComposer');
    }

    public function map()
    {
        $this->mapSiteRoutes();

    }

    protected function mapSiteRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(app_path('Applications/Site/Http/routes.php'));
    }
}