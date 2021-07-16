<?php
namespace App\Services;

use App\Repositories\Contracts\FormPaymentRepositoryInterface;
use App\Repositories\Contracts\TenantRepositoryInterface;

class FormPaymentService
{
    protected $formPaymentRepository, $tenantRepository;

    public function __construct(
        FormPaymentRepositoryInterface $formPaymentRepository,
        TenantRepositoryInterface $tenantRepository
    )
    {
        $this->formPaymentRepository = $formPaymentRepository;
        $this->tenantRepository = $tenantRepository;
    }

    public function listFormPayment()
    {
        $idTenant = $this->tenantId();

        // $tenant = $this->tenantRepository->getTenantByFlag($flagTenant);
        return $this->formPaymentRepository->getFormPaymentsByTenantId($idTenant);
    }

    public function storeFormPayment(array $data)
    {
        $idTenant = $this->tenantId();
        // $tenant = $this->tenantRepository->getTenantByFlag($flagTenant);
        return $this->formPaymentRepository->createFormPaymentTenantId($idTenant, $data);
    }

    public function showFormPayment(string $flagFormPayment)
    {
        $idTenant = $this->tenantId();

        // if( !$tenant = $this->tenantRepository->getTenantByFlag($flagTenant) )
        //     return false;

        return $this->formPaymentRepository->getFormPaymentUrlByTenantId($idTenant, $flagFormPayment);
    }

    public function updateFormPayment(string $flagFormPayment, array $data)
    {
        $idTenant = $this->tenantId();

        // $tenant = $this->tenantRepository->getTenantByFlag($flagTenant);
        return $this->formPaymentRepository->updateFormPaymentUrlByTenantId($idTenant, $flagFormPayment, $data);
    }

    public function deleteFormPayment(string $flagFormPayment)
    {
        $idTenant = $this->tenantId();

        // $tenant = $this->tenantRepository->getTenantByFlag($flagTenant);
        return $this->formPaymentRepository->deleteFormPaymentUrlByTenantId($idTenant, $flagFormPayment);

    }

    public function tenantId()
    {
        return auth('web')->user()->tenant->id;
    }
}
