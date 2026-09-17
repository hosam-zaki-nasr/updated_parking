<?php

namespace Driver\Providers;

use App\Models\Parking;
use App\Models\RequestDriver;
use Driver\Providers\Observers\ParkingObserver;
use Driver\Providers\Observers\RequestDriverObserver;
use Illuminate\Support\ServiceProvider;

class ActiveRecordServiceProvider extends ServiceProvider
{

    public function boot()
    {
        RequestDriver::observe(RequestDriverObserver::class);
        Parking::observe(ParkingObserver::class);
    }
}
