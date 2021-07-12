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

    public function storeFormPayment(string $flagTenant, array $data)
    {
        $tenant = $this->tenantRepository->getTenantByFlag($flagTenant);
        return $this->formPaymentRepository->createFormPaymentTenantId($tenant->id, $data);
    }

    public function showFormPayment(string $flagTenant, string $flagFormPayment)
    {
        if( !$tenant = $this->tenantRepository->getTenantByFlag($flagTenant) )
            return false;

        return $this->formPaymentRepository->getFormPaymentUrlByTenantId($tenant->id, $flagFormPayment);
    } 
    
    public function updateFormPayment(string $flagTenant, string $flagFormPayment, array $data)
    {
        $tenant = $this->tenantRepository->getTenantByFlag($flagTenant);
        return $this->formPaymentRepository->updateFormPaymentUrlByTenantId($tenant->id, $flagFormPayment, $data);
    }

    public function deleteFormPayment(string $flagTenant, string $flagFormPayment)
    {
        $tenant = $this->tenantRepository->getTenantByFlag($flagTenant);
        return $this->formPaymentRepository->deleteFormPaymentUrlByTenantId($tenant->id, $flagFormPayment);

    }

    public function tenantId()
    {
        return auth()->user()->tenant->id;
    }
}