<?php

namespace App\Models;

use App\Tenant\Traits\TenantTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Coupon extends Model
{
    use HasFactory, TenantTrait;

    protected $fillable = [
        "tenant_id",
        "name",
        "description",
        "uuid",
        "discount",
        "discount_mode",
        "limit",
        "limit_mode",
        "start_validity",
        "end_validity",
        "active",
    ];
    
    public function tenant()
    {
        return $this->belongsToMany(Tenant::class);
    }
}