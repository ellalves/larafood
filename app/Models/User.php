<?php

namespace App\Models;

use App\Models\Traits\UserACLTrait;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, UserACLTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'pĺan_id',
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

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function userRoleAvailable($filter = null)
    {
        return Role::whereNotIn('roles.id', function ($query) {
            $query->select('ur.role_id');
            $query->from('role_user AS ur');
            $query->whereRaw("ur.user_id={$this->id}");
        })
        ->where(function($query) use ($filter) {
            $query->where('name', 'LIKE', "%{$filter}%");
        });
    }

    public function search($filter = null)
    {
        $users = $this->join('tenants', 'tenants.id', '=', 'users.tenant_id')
            ->where(function ($query) use ($filter) {
                if ($filter) {
                    $query->where('users.name', 'LIKE', "%{$filter}%");
                    $query->orWhere('tenants.name', 'LIKE', "%{$filter}%");
                }
            })
            ->select('users.*')
            ->latest()
            ->with('tenant')
            ->tenantUser();
    
        return $users;
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Scope a query to only include popular users.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeTenantUser(Builder $query)
    {
        // Retorna as usuarios da tenant atual
        return $query->where('tenant_id', auth()->user()->tenant_id);
    }

}
