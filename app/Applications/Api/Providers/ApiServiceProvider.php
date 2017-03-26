<?php

namespace App\Applications\Api\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class ApiServiceProvider extends ServiceProvider
{

    protected $namespace = 'App\Applications\Api\Http\Controllers';

    public function boot()
    {
        //

        parent::boot();
    }

    public function map()
    {
        $this->mapApiRoutes();

    }

    protected function mapApiRoutes()
    {
        Route::prefix('api')
            ->middleware('api')
            ->namespace($this->namespace)
            ->group(app_path('Applications/Api/Http/routes.php'));
    }
}