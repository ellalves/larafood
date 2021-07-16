<?php
namespace App\Repositories;

use App\Models\FormPayment;
use App\Repositories\Contracts\FormPaymentRepositoryInterface;

class FormPaymentRepository implements FormPaymentRepositoryInterface
{
    protected $entity;

    public function __construct(FormPayment $formPayment)
    {
        $this->entity = $formPayment;
    }

    public function getFormPaymentsByTenantId(int $idTenant)
    {
        $formPayments = $this->entity
                            ->where('tenant_id', $idTenant)
                            ->paginate();

        return $formPayments;
    }

    public function createFormPaymentTenantId(int $idTenant, array $data)
    {
        $data['tenant_id'] = $idTenant;
        return $this->entity->withoutGlobalScope(TenantScope::class)->create($data);
    }

    public function updateFormPaymentUrlByTenantId(int $idTenant, string $flagFormPayment, array $data)
    {
        $formPayment = $this->entity
                            ->where('url', $flagFormPayment)
                            ->where('tenant_id', $idTenant)
                            ->withoutGlobalScope(TenantScope::class)
                            ->first();

        $formPayment->update($data);

        return $formPayment;
    }

    public function getFormPaymentUrlByTenantId(int $idTenant, string $flagFormPayment)
    {
        $formPayment = $this->entity
                            ->where('tenant_id', $idTenant)
                            ->where('url', $flagFormPayment)
                            ->first();

        return $formPayment;
    }

    public function deleteFormPaymentUrlByTenantId(int $idTenant, string $flagFormPayment)
    {
        $formPayment = $this->entity
                            ->where('url', $flagFormPayment)
                            ->where('tenant_id', $idTenant)
                            ->first();

        $formPayment->delete();

        return  $formPayment;
    }
}
