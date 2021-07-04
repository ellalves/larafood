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

    public function getProductsByTenantUuid($uuidTenant, $categories = null)
    {
        $tenant = $this->tenantRepository->getTenantByUuid($uuidTenant);
        $products = $this->productRepository->getProductsByTenantId($tenant->id, $categories);
        return $products;
    }

    public function getProductsFilterByTenantUuid($uuidTenant, $filter = null)
    {
        $tenant = $this->tenantRepository->getTenantByUuid($uuidTenant);
        $products = $this->productRepository->getProductsFilterByTenantId($tenant->id, $filter);
        return $products;
    }

    public function getProductByFlag($uuidTenant, $uuidProduct)
    {
        $tenant = $this->tenantRepository->getTenantByUuid($uuidTenant);
        return $this->productRepository->getProductByUuid($tenant->id, $uuidProduct);
    }
}