<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to your application's "home" route.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */

    // The default path to the application home (users are typically redirected to this path after authentication)
    public const HOME = '/dashboard';

    // This is a default namespace for controller classes (used for defining the routes in the web.php file)
    protected $namespace = 'App\Http\Controllers';
    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */

    
    // This function runs when the application starts or boots.
    public function boot(): void
    {
        // Rate limiting for API Routes (60 per minute)
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        // Route Configuration:
        // This route separates application routes and API routes
        $this->routes(function () {
            // For api route: middleware 'api' is used and the routes are prefixed by 'api', the routes are defined inside 'routes/api.php' 
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            // For web routes: the 'web' middleware is applied and the routes use the controller namespace(to use different controllers), these routes are defined inside 'routes/web.php'
            Route::middleware('web')
                ->namespace($this -> namespace)
                ->group(base_path('routes/web.php'));
        });
    }
}