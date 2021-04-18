<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description'];

    /**
     * Get Permissions
     */ 
    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    /**
     * Get plans
     */
    public function plans()
    {
        return $this->belongsToMany(Plan::class, 'plan_group');
    }

    /**
     * Permissions not linked with this group
     */
    public function permissionsAvailable($filter = null)
    {
        $permissions = Permission::whereNotIn('id', function($query) {
            $query->select('group_permission.permission_id');
            $query->from('group_permission');
            $query->whereRaw("group_permission.group_id={$this->id}");
        })
        ->where(function($queryFilter) use ($filter) {
            if ($filter)
                $queryFilter->where('permissions.name', 'LIKE', "%{$filter}%");
        });

        return $permissions;
    }
}
