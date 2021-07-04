<?php

namespace App\Models;

use Carbon\Carbon;
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

    public function orders()
    {
        return $this->belongsToMany(Order::class)->withPivot(['price', 'qty', 'coupon', 'discount', 'paid']);
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

    public function getPriceBrAttribute()
    {
        return number_format($this->price, 2, ',', '.');
    }

    public function getCreatedAttribute()
    {
        return Carbon::make($this->created_at)->format("d/m/Y à\s H:i:s");
    }

    public function getUpdatedAttribute()
    {
        return Carbon::make($this->updated_at)->format("d/m/Y à\s H:i:s");
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
                        ->orWhere('description', 'LIKE', "%{$filter}%")
                        ->orWhere('uuid', 'LIKE', "%{$filter}%");

        return $results;
    }
}
