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

    // public function getTablesByTenantUuid(string $uuid)
    // {
    //     return $this->entity
    //                         ->withoutGlobalScope(TenantScope::class)
    //                         ->join('tenants', 'tenants.id', '=', 'tables.tenant_id')
    //                         ->where('tenants.uuid', $uuid)
    //                         ->select('tables.*')
    //                         ->latest()
    //                         ->get();
    // }

    public function getTablesByTenantId(int $idTenant)
    {
        return $this->entity
                        ->select(
                            'uuid AS uuid_tab', 
                            'name AS name_tab', 
                            'description AS description_tab'
                        )
                        ->where('tenant_id', $idTenant)
                        ->withoutGlobalScope(TenantScope::class)
                        ->get();
    }

    public function getTableByUuid(string $uuid)
    {
        return $this->entity
                        ->select(
                            'uuid AS uuid_tab', 
                            'name AS name_tab', 
                            'description AS description_tab'
                        )
                        ->where('uuid', $uuid)
                        ->firstOrFail();
    }
}