<?php

namespace App\Providers;

use App\Models\{
    Category,
    Client,
    Coupon,
    DetailPlan,
    FormPayment,
    Plan,
    Tenant,
    Product,
    Table,
    User,
    Role,
    Permission,
    Group,
    Provider
};
use App\Observers\{
    CategoryObserver,
    ClientObserver,
    CouponObserver,
    DetailPlanObserver,
    FormPaymentObserver,
    PlanObserver,
    ProductObserver,
    TableObserver,
    TenantObserver,
    UserObserver,
    RoleObserver,
    PermissionObserver,
    GroupObserver,
    ProviderObserver
};

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // 
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
        Plan::observe(PlanObserver::class);
        Tenant::observe(TenantObserver::class);
        Category::observe(CategoryObserver::class);
        Product::observe(ProductObserver::class);
        Table::observe(TableObserver::class);
        Client::observe(ClientObserver::class);
        Group::observe(GroupObserver::class);
        Permission::observe(PermissionObserver::class);
        Role::observe(RoleObserver::class);
        User::observe(UserObserver::class);
        DetailPlan::observe(DetailPlanObserver::class);
        Coupon::observe(CouponObserver::class);
        Provider::observe(ProviderObserver::class);
        FormPayment::observe(FormPaymentObserver::class);

        /**
         * Custom If Statements
         */
        Blade::if('admin', function () {
            return auth()->user()->isAdmin();
        });
    }
}
