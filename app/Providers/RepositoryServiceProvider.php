<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Repositories\ItemRepositoryInterface;
use App\Repositories\ItemRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            ItemRepositoryInterface::class,
            ItemRepository::class
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
