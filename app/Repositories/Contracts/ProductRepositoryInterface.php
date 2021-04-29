<?php

namespace App\Repositories\Contracts;

interface ProductRepositoryInterface
{
    public function getProductsByTenantId(int $idTenant, array $categories = null);
    public function getProductByFlag(int $idTenant, string $flag);
}
