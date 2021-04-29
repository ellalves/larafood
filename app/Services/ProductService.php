<?php
namespace App\Services;

use App\Repositories\Contracts\ProductRepositoryInterface;
use App\Repositories\Contracts\TenantRepositoryInterface;

class ProductService
{
    protected $tenantRepository, $productRepository; 
    
    public function __construct(
        TenantRepositoryInterface $tenantRepository,
        ProductRepositoryInterface $productRepository
    )
    {
        $this->tenantRepository = $tenantRepository;
        $this->productRepository = $productRepository;
    }

    public function getProductByTenantUuid($uuid, $categories = null)
    {
        $tenant = $this->tenantRepository->getTenantByUuid($uuid);
        $products = $this->productRepository->getProductsByTenantId($tenant->id, $categories);
        return $products;
    }

    public function getProductByFlag($uuid, $flag)
    {
        $tenant = $this->tenantRepository->getTenantByUuid($uuid);
        return $this->productRepository->getProductByFlag($tenant->id, $flag);
    }
}