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

    public function getTablesByTenantId(int $idTenant)
    {
        return $this->entity
                        ->where('tenant_id', $idTenant)
                        ->withoutGlobalScope(TenantScope::class)
                        ->get();
    }

    public function getTableIdentifyByTenantId(int $idTenant, string $identify)
    {
        $table = $this->entity
                        ->where('uuid', $identify)
                        ->where('tenant_id',$idTenant )
                        ->withoutGlobalScope(TenantScope::class)
                        ->firstOrFail();

        return $table;
    }

    public function getTablesSearch(int $idTenant, string $filter)
    {
        return $this->entity
                        ->where('tenant_id', $idTenant)
                        ->where('name', 'LIKE' , "%{$filter}%")
                        ->withoutGlobalScope(TenantScope::class)
                        ->paginate(10);        
    }
}