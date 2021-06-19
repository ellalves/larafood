<?php
namespace App\Repositories;

use App\Models\Provider;
use App\Repositories\Contracts\ProviderRepositoryInterface;

class ProviderRepository implements ProviderRepositoryInterface
{
    protected $entity;

    public function __construct(Provider $provider)
    {
        $this->entity = $provider;
    }

    public function getProvidersByTenantId(int $idTenant)
    {
        $providers = $this->entity
                            ->where('tenant_id', $idTenant)
                            ->paginate();
        
        return $providers;
    }

    public function createProviderTenantId(int $idTenant, array $data)
    {
        $data['tenant_id'] = $idTenant;
        return $this->entity->create($data);
    }

    public function updateProviderUrlByTenantId(int $idTenant, string $flagProvider, array $data)
    {
        $provider = $this->entity
                            ->where('url', $flagProvider)
                            ->where('tenant_id', $idTenant)
                            ->first();

        $provider->update($data);

        return $provider;
    }

    public function getProviderUrlByTenantId(int $idTenant, string $flagProvider)
    {
        return $this->entity
                        ->where('url', $flagProvider)
                        ->where('tenant_id', $idTenant)
                        ->first();
    }

    public function deleteProviderUrlByTenantId(int $idTenant, string $flagProvider)
    {
        $provider = $this->entity
                            ->where('url', $flagProvider)
                            ->where('tenant_id', $idTenant)
                            ->first();

        $provider->delete();

        return  $provider;
    }
}