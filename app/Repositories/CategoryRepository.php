<?php
namespace App\Repositories;

use App\Models\Category;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use App\Tenant\Scopes\TenantScope;

class CategoryRepository implements CategoryRepositoryInterface
{
    protected $entity, $tenant;

    public function __construct(Category $category)
    {
        $this->entity = $category;
    }

    public function getCategoriesByTenantUuid(string $uuid)
    {
        return $this->entity
                        ->withoutGlobalScope(TenantScope::class)
                        ->join('tenants', 'tenants.id', '=', 'categories.tenant_id')
                        ->where('tenants.uuid', $uuid)
                        ->select('categories.*')
                        ->get();
    }

    public function getCategoriesByTenantId(int $idTenant)
    {
        return $this->entity
                        ->where('tenant_id', $idTenant)
                        ->with('tenant')
                        ->withoutGlobalScope(TenantScope::class)
                        ->get();
    }


    public function getCategoryFlagByTenantId(int $idTenant, string $flag)
    {
        $category = $this->entity
                            ->where('url', $flag)
                            ->where('tenant_id', $idTenant)
                            ->withoutGlobalScope(TenantScope::class)
                            ->first();
        
        return $category;
    }
}