<?php
namespace App\Repositories\Contracts;

interface CategoryRepositoryInterface
{
    public function getCategoriesByTenantUuid(string $uuid);
    public function getCategoriesByTenantId(int $idTenant);
    public function getCategoryFlagByTenantId(int $idTenant, string $flag);
}