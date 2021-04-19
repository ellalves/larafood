<?php

namespace App\Services;

use App\Models\Plan;
use Illuminate\Support\Facades\Hash;

class TenantService 
{
    protected $plan, $data = [];

    public function make(Plan $plan, array $data)
    {
        $this->plan = $plan;
        $this->data = $data;
        
        $tenant = $this->storeTenant(); // Return Tenants
        
        return $this->storeUser($tenant); // return User
    }

    public function storeTenant()
    {
        $tenant = $this->plan->tenants()->create([
            'document' => $this->data['document'],
            'name' => $this->data['company'],
            'email' => $this->data['email'],
            
            'subscription' => now(),
            'expires_at' => now()->addDays(7),
        ]);

        return $tenant;
    }    
    
    public function storeUser($tenant)
    {
        return $tenant->users()->create([
            'name' => $this->data['name'],
            'email' => $this->data['email'],
            'password' => Hash::make($this->data['password']),
        ]);         
    }

}