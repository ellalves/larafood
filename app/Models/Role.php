<?php

namespace App\Models;

use App\Tenant\ManagerTenant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description'];

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function roleUserAvailable($filter)
    {
        return User::whereNotIn('users.id', function($query) {
            $query->select('ru.user_id');
            $query->from('role_user AS ru');
            $query->whereRaw("ru.role_id={$this->id}");
        })
        ->where(function($queryFilter) use ($filter) {
            if ($filter) {
                $queryFilter->where('users.name', 'LIKE', "%{$filter}%");
                $queryFilter->where('users.email', 'LIKE', "%{$filter}%");
            }
        })
        ->where('tenant_id', app(ManagerTenant::class)->getTenantIdentify());
    }

    public function permissionsAvailable($filter) 
    {
        $permissions = Permission::whereNotIn('permissions.id', function($query) {
            $query->select('permission_role.permission_id');
            $query->from('permission_role');
            $query->whereRaw("permission_role.role_id={$this->id}");
        })
        ->where(function($queryFilter) use ($filter) {
            if ($filter)
                $queryFilter->where('permissions.name', 'LIKE', "%{$filter}%");
        });

        return $permissions;
    }
}
