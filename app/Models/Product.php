<?php

namespace App\Models;

use Illuminate\Http\Request;
use App\Tenant\Traits\TenantTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory, TenantTrait;

    protected $fillable = ['title', 'url', 'price', 'description', 'image', 'tenant_id'];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_product');
    }

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }
    
    public function categoriesAvailable($filter = null)
    {
        $categories = Category::whereNotIn('categories.id', function($query) {
            $query->select('category_product.category_id');
            $query->from('category_product');
            $query->whereRaw("category_product.product_id={$this->id}");
        })
        ->where(function($queryFilter) use ($filter) {
            if ($filter){
                $queryFilter->where('title', 'LIKE', "%{$filter}%");
                $queryFilter->orWhere('description', 'LIKE', "%{$filter}%");
            }
        });

        return $categories;
    }

    /**
     * Search results
     *
     * @param  Request $request $filter
     * @return \Illuminate\Http\Response
     */
    public function search($filter = null) 
    {
        $results = $this->where('title', 'LIKE',  "%{$filter}%")
                        ->orWhere('description', 'LIKE', "%{$filter}%");

        return $results;
    }
}
