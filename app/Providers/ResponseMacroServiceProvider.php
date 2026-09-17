<?php

namespace App\Providers;

use Illuminate\Routing\ResponseFactory;
use Illuminate\Support\ServiceProvider;

class ResponseMacroServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(ResponseFactory $factory)
    {
        $factory->macro('success', function (string $message = '', $data = null, int $status_code = 200) use ($factory) {

            return $factory->make([
                'status_code' => $status_code,
                'message' => $message,
                'data' => $data,
            ], $status_code);
        });


        $factory->macro('error', function (string $message = '', $errors = [], int $status_code = 400) use ($factory) {

            return $factory->make([
                'status_code' => $status_code,
                'message' => $message,
            ], $status_code);
        });

        $factory->macro('paginated', function ($data = null) {

            return $data;
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
