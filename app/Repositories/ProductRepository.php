<?php
namespace App\Repositories;

use App\Models\Product;
use App\Repositories\Contracts\ProductRepositoryInterface;
use App\Tenant\Scopes\TenantScope;

class ProductRepository implements ProductRepositoryInterface
{
    protected $entity;

    public function __construct(Product $product)
    {
        $this->entity = $product;
    }

    public function getProductsByTenantId(int $idTenant, array $categories = null)
    {
        $product = $this->entity
                            ->select('p.*')
                            ->distinct()
                            ->from('products  AS p')
                            ->join('category_product AS cp','cp.product_id','=', 'p.id')
                            ->join('categories AS c','c.id','=', 'category_id')
                            ->where(function ($query) use ($categories) {
                                if($categories != [])
                                    $query->whereIn('c.url', $categories);
                            })
                            ->where('p.tenant_id', $idTenant)
                            ->where('c.tenant_id', $idTenant)
                            ->withoutGlobalScope(TenantScope::class)
                            ->get();
        return $product;
    }

    public function getProductByFlag(int $idTenant, string $flag)
    {
        $product = $this->entity
                            ->where('flag', $flag)
                            ->where('tenant_id', $idTenant)
                            ->withoutGlobalScope(TenantScope::class)
                            ->first();
        return $product;
    }
}