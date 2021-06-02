<?php

namespace App\Services;

use App\Models\Plan;
use App\Repositories\Contracts\TenantRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class TenantService 
{
    protected $plan, $data = [];
    private $repository;

    public function __construct(TenantRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function getAllTenants()
    {
        return $this->repository->getAllTenants();
    }

    public function getTenantByUuid(string $uuid)
    {
        return $this->repository->getTenantByUuid($uuid);
    }

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
            'phone' => $this->data['phone'],
        ]);

        return $tenant;
    }    
    
    public function storeUser($tenant)
    {
        return $tenant->users()->create([
            'name' => $this->data['name'],
            'email' => $this->data['email'],
            'phone' => $this->data['phone'],
            'password' => Hash::make($this->data['password']),
        ]);         
    }
}