<?php

namespace App\Repositories;

use App\Models\Tenant;
use App\Repositories\Contracts\TenantRepositoryInterface;

class TenantRepository implements TenantRepositoryInterface
{
    protected $entity;

    public function __construct(Tenant $entity)
    {
        $this->entity = $entity;    
    }

    public function getAllTenants()
    {
        return $this->entity->all();
    }

    public function getTenantByUuid(string $uuid)
    {
        // dd($this->entity->where('uuid', $uuid)->first());
        $tenant = $this->entity->when($uuid, function($q) use ($uuid) {
            $q->where('uuid', $uuid);
        })
        ->firstOrFail();

        return $tenant;
    }

    public function getTenantByFlag(string $flag)
    {
        $tenant = $this->entity->when($flag, function($q) use ($flag) {
            $q->where('url', $flag);
        })
        ->firstOrFail();

        return $tenant;
    }
}