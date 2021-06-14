<?php

namespace App\Repositories\Contracts;

interface TenantRepositoryInterface 
{
    public function getAllTenants();
    public function getTenantByUuid(string $uuid);
    public function getTenantByFlag(string $flag);
}