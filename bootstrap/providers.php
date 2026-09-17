<?php

use App\Providers\AppServiceProvider;
use App\Providers\ResponseMacroServiceProvider;
use App\Providers\RouteServiceProvider;

return [
    AppServiceProvider::class,
    RouteServiceProvider::class,
    ResponseMacroServiceProvider::class,


    // Package Service Providers...

    Dashboard\Providers\RouteServiceProvider::class,
    Driver\Providers\RouteServiceProvider::class,
    Customer\Providers\RouteServiceProvider::class,
    Garage\Providers\RouteServiceProvider::class,

    Driver\Providers\ActiveRecordServiceProvider::class,

];
