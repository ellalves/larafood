<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    use HasFactory;

    protected $fillable = [
        "tenant_id",
        "uuid",
        "name",
        "url",
        "document",
        "email",
        "phone",
        "about",
        "address",        
    ];

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }
}
