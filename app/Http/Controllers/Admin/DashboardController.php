<?php

namespace App\Http\Controllers\Admin;

use App\Models\{
    Category,
    Group,
    Permission,
    Plan,
    Product,
    Role,
    Table,
    Tenant,
    User
};
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware()
    // }

    public function index()
    {
        $tenant = auth()->user();
        $totalUsers = User::where('tenant_id', $tenant->id)->count();

        $totalTables = Table::count();
        $totalProducts = Product::count();
        $totalCategories = Category::count();
        $totalTenants = Tenant::count();
        $totalPlans = Plan::count();
        $totalRoles = Role::count();
        $totalGroups = Group::count();
        $totalPermissions = Permission::count();

        return view('admin.pages.dashboard.index', compact(
            'totalUsers',
            'totalTables',
            'totalProducts',
            'totalCategories',
            'totalTenants',
            'totalPlans',
            'totalRoles',
            'totalGroups',
            'totalPermissions',
        ));
    }
}
