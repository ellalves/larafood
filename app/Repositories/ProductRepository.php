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


    public function getProductsFilterByTenantId(int $idTenant, string $filter = null)
    {
        $products = $this->entity
                            ->select('products.*')
                            ->with('categories')
                            ->when($filter, function ($query) use ($filter, $idTenant) {
                                $query->where('title', 'LIKE',  "%{$filter}%")
                                        ->orWhere('description', 'LIKE', "%{$filter}%")
                                        ->orWhere('uuid', 'LIKE', "%{$filter}%");

                                        $query->whereHas('categories', function($q) use ($filter, $idTenant) {
                                            $q->where('categories.tenant_id', $idTenant);
                                            $q->orWhere('categories.name', 'LIKE', "%{$filter}%");
                                        });
                            })
                            ->where('products.tenant_id', $idTenant)
                            ->withoutGlobalScope(TenantScope::class)
                            ->paginate(5);
        return $products;
    }

    public function getProductByUuid(int $idTenant, string $uuidProduct)
    {
        $product = $this->entity
                            ->where('uuid', $uuidProduct)
                            ->with('orders')
                            ->where('tenant_id', $idTenant)
                            ->withoutGlobalScope(TenantScope::class)
                            ->firstOrFail();
        return $product;
    }
}