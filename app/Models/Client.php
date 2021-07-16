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
        $results = $this->where('name', 'LIKE',  "%{$filter}%")
                        ->orWhere('phone', 'LIKE', "%{$filter}%")
                        ->orWhere('email', 'LIKE', "%{$filter}%")
                        ->orWhere('username', 'LIKE', "%{$filter}%")
                        ->orWhere('document', 'LIKE', "%{$filter}%");

        return $results->paginate(5);
    }
}
