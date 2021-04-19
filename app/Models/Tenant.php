<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'document', 'name', 'url', 'email', 'logo', 'active', 'uuid',
        'subscription', 'expires_at', 'subscription_id', 'subscription_active', 'subscription_suspended',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function categories()
    {
        return $this->hasMany(Category::class);
    }

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

    public function tables() {
        return $this->hasMany(Table::class);
    }
}
