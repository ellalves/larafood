<?php
namespace App\Services;

use App\Repositories\Contracts\TableRepositoryInterface;
use App\Repositories\Contracts\TenantRepositoryInterface;

class TableService
{
    protected $tableRepository, $tenantRepository;

    public function __construct(
        TableRepositoryInterface $tableRepository,
        TenantRepositoryInterface $tenantRepository
    )
    {
        $this->tableRepository = $tableRepository;
        $this->tenantRepository = $tenantRepository;
    }

    public function getTablesByTenantUuid($uuid)
    {
        $tenant = $this->tenantRepository->getTenantByUuid($uuid);

        return $this->tableRepository->getTablesByTenantId($tenant->id);
    }

    public function getTableByTenantUuid($uuidTenant, $identify)
    {
        $tenant = $this->tenantRepository->getTenantByUuid($uuidTenant);

        $table = $this->tableRepository->getTableIdentifyByTenantId($tenant->id, $identify);
        return $table;
    }

    public function getTablesSearch($request)
    {
        $idTenant = $request->user()->tenant->id;

        return $this->tableRepository->getTablesSearch($idTenant, $request->filter);
    }
}