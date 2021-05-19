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
        $products = $this->entity
                            ->select('products.*')
                            ->with('categories')
                            ->when($categories, function($query) use ($idTenant, $categories) {
                                $query->whereHas('categories', function($q) use ($idTenant, $categories) {
                                    $q->where('categories.tenant_id', $idTenant);
                                    $q->whereIn('categories.url', $categories);
                                });
                            })
                            ->where('products.tenant_id', $idTenant)
                            ->withoutGlobalScope(TenantScope::class)
                            ->paginate();
        return $products;
    }

    public function getProductByUuid(int $idTenant, string $uuidProduct)
    {
        $product = $this->entity
                            ->where('uuid', $uuidProduct)
                            ->where('tenant_id', $idTenant)
                            ->withoutGlobalScope(TenantScope::class)
                            ->firstOrFail();
        return $product;
    }
}