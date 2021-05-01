<?php


namespace App\Tenant;

use App\Models\Tenant;

class ManagerTenant
{
    public function getTenantIdentify()
    {
        // return auth()->user()->tenant_id;
        return auth()->check() ? auth()->user()->tenant_id : '';
    }

    public function getTenant()
    {
        // return auth()->user()->tenant;
        return auth()->check() ? auth()->user()->tenant_id : '';
    }

    public function isAdmin(): bool
    {
        return in_array(auth()->user()->email, config('tenant.admins'));
    }
}