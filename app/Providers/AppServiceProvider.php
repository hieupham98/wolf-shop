<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\RegularItemQualityUpdater;
use App\Services\AppleAirPodsQualityUpdater;
use App\Services\SamsungGalaxyS23QualityUpdater;
use App\Services\AppleIPadAirQualityUpdater;
use App\Services\XiaomiRedmiNote13QualityUpdater;
use App\Services\ImageUploadService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(RegularItemQualityUpdater::class, RegularItemQualityUpdater::class);
        $this->app->bind(AppleAirPodsQualityUpdater::class, AppleAirPodsQualityUpdater::class);
        $this->app->bind(SamsungGalaxyS23QualityUpdater::class, SamsungGalaxyS23QualityUpdater::class);
        $this->app->bind(AppleIPadAirQualityUpdater::class, AppleIPadAirQualityUpdater::class);
        $this->app->bind(XiaomiRedmiNote13QualityUpdater::class, XiaomiRedmiNote13QualityUpdater::class);
        $this->app->bind(ImageUploadService::class, ImageUploadService::class);
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
