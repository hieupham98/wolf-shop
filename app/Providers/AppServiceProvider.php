<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\RegularItemQualityUpdater;
use App\Services\AppleAirPodsQualityUpdater;
use App\Services\SamsungGalaxyS23QualityUpdater;
use App\Services\AppleIPadAirQualityUpdater;
use App\Services\XiaomiRedmiNote13QualityUpdater;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(RegularItemQualityUpdater::class, function ($app) {
            return new RegularItemQualityUpdater();
        });
        $this->app->bind(AppleAirPodsQualityUpdater::class, function ($app) {
            return new AppleAirPodsQualityUpdater();
        });
        $this->app->bind(SamsungGalaxyS23QualityUpdater::class, function ($app) {
            return new SamsungGalaxyS23QualityUpdater();
        });
        $this->app->bind(AppleIPadAirQualityUpdater::class, function ($app) {
            return new AppleIPadAirQualityUpdater();
        });
        $this->app->bind(XiaomiRedmiNote13QualityUpdater::class, function ($app) {
            return new XiaomiRedmiNote13QualityUpdater();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
