<?php
namespace App\Repositories\Contracts;

interface TableRepositoryInterface
{
    // public function getTablesByTenantUuid(string $uuid);
    public function getTablesByTenantId(int $id);
    public function getTableIdentifyByTenantId(int $idTenant, string $identify);
    public function getTablesSearch(int $idTenant, string $filter);
}