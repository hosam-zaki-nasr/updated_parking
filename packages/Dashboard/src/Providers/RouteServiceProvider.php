<?php

namespace Dashboard\Providers;

use App\Models\Country;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(Router $router)
    {
        $this->configureRateLimiting();

        foreach (glob(base_path('/packages/Dashboard/routes/*.php')) as $file) {
            Route::prefix('api/admin')
                ->middleware(['api'])
                ->group($file);
        }

        $this->bindRoutes($router);
    }

    protected function bindRoutes(Router $router)
    {
        $router->bind('country', function ($value) {
            return Country::loadCountry($value);
        });

        $router->bind('governorate', function ($value) {
            return Country::loadGovernorate($value);
        });

        $router->bind('city', function ($value) {
            return Country::loadCity($value);
        });

        $router->bind('zone', function ($value) {
            return Country::loadZone($value);
        });

        $router->bind('district', function ($value) {
            return Country::loadDistrict($value);
        });
    }


    /**
     * Configure the rate limiters for the application.
     */
    protected function configureRateLimiting(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }
}
