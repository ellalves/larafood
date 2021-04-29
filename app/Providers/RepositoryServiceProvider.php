<?php

namespace App\Providers;

use App\Repositories\Contracts\{
    TableRepositoryInterface,
    CategoryRepositoryInterface,
    ProductRepositoryInterface,
    TenantRepositoryInterface
};

use App\Repositories\{
    TableRepository,
    CategoryRepository,
    ProductRepository,
    TenantRepository
};

use Illuminate\Support\ServiceProvider;

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
            TenantRepositoryInterface::class,
            TenantRepository::class,
        );

        $this->app->bind(
            CategoryRepositoryInterface::class,
            CategoryRepository::class,
        );
        
        $this->app->bind(
            TableRepositoryInterface::class,
            TableRepository::class,
        );

        $this->app->bind(
            ProductRepositoryInterface::class,
            ProductRepository::class
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
