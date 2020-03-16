<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();
        $this->mapAdminRoutes();
        $this->mapClientRoutes();
        $this->mapBelieverRoutes();
        $this->mapReferralRoutes();
        $this->mapWebRoutes();

        //
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/web.php'));
    }

    protected function mapAdminRoutes()
    {
        Route::middleware(['web','admin.auth', 'can:accessAdminRoutes'])
             ->namespace($this->namespace)
             ->group(base_path('routes/admin.php'));
    }   
    
    protected function mapClientRoutes()
    {
        Route::middleware(['web','admin.auth', 'can:accessClientRoutes'])
             ->namespace($this->namespace)
             ->group(base_path('routes/client.php'));
    }
    
    protected function mapBelieverRoutes()
    {
        Route::middleware(['web','admin.auth', 'can:accessBelieverRoutes'])
             ->namespace($this->namespace)
             ->group(base_path('routes/believer.php'));
    }       

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
             ->middleware('api')
             ->namespace($this->namespace)
             ->group(base_path('routes/api.php'));
    }

    protected function mapReferralRoutes()
    {
        Route::namespace($this->namespace)
             ->group(base_path('routes/referral.php'));
    }
}
