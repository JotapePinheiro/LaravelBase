<?php

namespace App\Applications\Admin\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class AdminServiceProvider extends ServiceProvider
{

    protected $namespace = 'App\Applications\Admin\Http\Controllers';

    public function boot()
    {
        //

        parent::boot();
        $this->loadViewsFrom(__DIR__.'/../resources/views','admin');
    }

    public function map()
    {
        $this->mapSiteRoutes();

    }

    protected function mapSiteRoutes()
    {
        Route::prefix('admin')
            ->middleware('web')
            ->namespace($this->namespace)
            ->group(app_path('Applications/Admin/Http/routes.php'));
    }
}