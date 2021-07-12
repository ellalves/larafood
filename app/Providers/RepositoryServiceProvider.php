<?php

namespace App\Providers;

use App\Repositories\{
    AddressRepository,
    TableRepository,
    CategoryRepository,
    ClientRepository,
    CouponRepository,
    EvaluationRepository,
    FormPaymentRepository,
    ProductRepository,
    TenantRepository,
    OrderRepository,
    ProviderRepository,
    UserRepository
};

use App\Repositories\Contracts\{
    AddressRepositoryInterface,
    TableRepositoryInterface,
    CategoryRepositoryInterface,
    ClientRepositoryInterface,
    CouponRepositoryInterface,
    EvaluationRepositoryInterface,
    FormPaymentRepositoryInterface,
    ProductRepositoryInterface,
    TenantRepositoryInterface,
    OrderRepositoryInterface,
    ProviderRepositoryInterface,
    UserRepositoryInterface
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

        $this->app->bind(
            ClientRepositoryInterface::class,
            ClientRepository::class
        );

        $this->app->bind(
            OrderRepositoryInterface::class,
            OrderRepository::class
        );

        $this->app->bind(
            EvaluationRepositoryInterface::class,
            EvaluationRepository::class
        );

        $this->app->bind(
            AddressRepositoryInterface::class,
            AddressRepository::class
        );

        $this->app->bind(
            CouponRepositoryInterface::class,
            CouponRepository::class
        );

        $this->app->bind(
            ProviderRepositoryInterface::class,
            ProviderRepository::class
        );

        $this->app->bind(
            FormPaymentRepositoryInterface::class,
            FormPaymentRepository::class
        );

        $this->app->bind(
            UserRepositoryInterface::class,
            UserRepository::class
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
