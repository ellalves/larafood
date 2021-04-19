<?php

namespace App\Models\Traits;

trait UserACLTrait {

    /**
     * Permissions 
     */
    public function permissions() 
    {
        $tenant = $this->tenant;

        $plan = $tenant->plan;

        $permissions = [];
 
        foreach ($plan->groups as $group) {
            foreach ($group->permissions as $permission) {
                array_push($permissions, $permission->name);
            }
        }
        
        return $permissions;
    }

    /**
     * hasPermission
     */
    public function hasPermission(string $permissionName): bool
    {
        return in_array($permissionName, $this->permissions());
    }

    public function isAdmin(): bool
    {
        return in_array($this->email, config('acl.admins'));
    }    
    
    public function isNotAdmin(): bool
    {
        return !$this->isAdmin();
    }
}