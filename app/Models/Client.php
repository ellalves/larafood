<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Lecturize\Addresses\Traits\HasAddresses;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Client extends Authenticatable
{
    use HasFactory, HasApiTokens, HasAddresses;

    protected $fillable = [
        'tenant_id',
        'uuid',
        'name',
        'document',
        'username',
        'email',
        'phone',
        'password',
        'birth',
        'sex',
        'bio',
        'photo',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function search($filter)
    {
        return $this->when($filter, function ($query) use ($filter) {
            $query->where('name', $filter);
            $query->orWhere('email', $filter);
            $query->orWhere('username', $filter);
            $query->orWhere('phone', $filter);
            $query->orWhere('document', $filter);
        });
    }
}
