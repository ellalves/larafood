<?php
namespace App\Services;

use App\Repositories\ProviderRepository;
use App\Repositories\Contracts\ProviderRepositoryInterface;
use App\Repositories\Contracts\TenantRepositoryInterface;

class ProviderService
{
    protected $providerRepository, $tenantRepository;
    
    public function __construct(
        ProviderRepositoryInterface $providerRepository,
        TenantRepositoryInterface $tenantRepository
    
        )
    {
        $this->providerRepository = $providerRepository;
        $this->tenantRepository = $tenantRepository;
    }

    public function listProvider($flagTenant)
    {
        $tenant = $this->tenantRepository->getTenantByFlag($flagTenant);
        return $this->providerRepository->getProvidersByTenantId($tenant->id);
    }

    public function storeProvider(string $flagTenant, array $data)
    {
        $tenant = $this->tenantRepository->getTenantByFlag($flagTenant);
        return $this->providerRepository->createProviderTenantId($tenant->id, $data);
    }

    public function showProvider(string $flagTenant, string $flagProvider)
    {
        $tenant = $this->tenantRepository->getTenantByFlag($flagTenant);
        return $this->providerRepository->getProviderUrlByTenantId($tenant->id, $flagProvider);
    } 
    
    public function updateProvider(string $flagTenant, string $flagProvider, array $data)
    {
        $tenant = $this->tenantRepository->getTenantByFlag($flagTenant);
        return $this->providerRepository->updateProviderUrlByTenantId($tenant->id, $flagProvider, $data);
    }

    public function deleteProvider(string $flagTenant, string $flagProvider)
    {
        $tenant = $this->tenantRepository->getTenantByFlag($flagTenant);
        return $this->providerRepository->deleteProviderUrlByTenantId($tenant->id, $flagProvider);

    }
}