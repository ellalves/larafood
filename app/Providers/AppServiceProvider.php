<?php

namespace App\Providers;

use App\Models\{
    Category,
    Client,
    DetailPlan,
    Plan,
    Tenant,
    Product,
    Table,
    User,
    Role,
    Permission,
    Group
};
use App\Observers\{
    CategoryObserver,
    ClientObserver,
    DetailPlanObserver,
    PlanObserver,
    ProductObserver,
    TableObserver,
    TenantObserver,
    UserObserver,
    RoleObserver,
    PermissionObserver,
    GroupObserver
};
// use App\Repositories\Contracts\{
//     TenantRepositoryInterface,
// };
// use App\Repositories\TenantRepository;
use Illuminate\Pagination\Paginator;
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
    }
}
