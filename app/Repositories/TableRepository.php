<?php
namespace App\Repositories;

use App\Models\Table;
use App\Tenant\Scopes\TenantScope;
use App\Repositories\Contracts\TableRepositoryInterface;

class TableRepository implements TableRepositoryInterface
{
    protected $entity;

    public function __construct(Table $entity)
    {
        $this->entity = $entity;    
    }

    public function getTablesByTenantUuid(string $uuid)
    {
        return $this->entity
                            ->withoutGlobalScope(TenantScope::class)
                            ->join('tenants', 'tenants.id', '=', 'tables.tenant_id')
                            ->where('tenants.uuid', $uuid)
                            ->select('tables.*')
                            ->latest()
                            ->get();
    }

    public function getTablesByTenantId(int $idTenant)
    {
        return $this->entity
                            ->where('tenant_id', $idTenant)
                            ->withoutGlobalScope(TenantScope::class)
                            ->get();
    }
}