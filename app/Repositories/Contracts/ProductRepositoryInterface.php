<?php

namespace App\Repositories\Contracts;

interface ProductRepositoryInterface
{
    public function getProductsByTenantId(int $idTenant, array $categories = null);
    public function getProductsFilterByTenantId(int $idTenant, string $filter = '');
    public function getProductByUuid(int $idTenant, string $uuid);
}
