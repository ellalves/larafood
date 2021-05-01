<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Client extends Authenticatable
{
    use HasFactory, HasApiTokens;

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
}
