<?php
namespace App\Services;

use App\Models\Coupon;
use App\Repositories\Contracts\CouponRepositoryInterface;
use App\Repositories\Contracts\TenantRepositoryInterface;

class CouponService
{
    protected $entity, $couponRepository, $tenantRepository;
    
    public function __construct(
        CouponRepositoryInterface $couponRepository,
        TenantRepositoryInterface $tenantRepository,
        Coupon $coupon
    )
    {
        $this->couponRepository = $couponRepository;
        $this->tenantRepository = $tenantRepository;
        $this->entity = $coupon;
    }


    public function listCoupons(string $flagTenant)
    {
        $tenant = $this->getTenant($flagTenant);

        return $this->couponRepository->getCouponsByTenantId($tenant->id);
    }

    public function storeCoupon(string $flagTenant, array $data)
    {
        $tenant = $this->getTenant($flagTenant);

        $coupon = $this->couponRepository
                        ->createCouponTenantId($tenant->id, $data);
        return $coupon;
    }

    public function showCoupon(string $flagTenant, string $flagCoupon)
    {
        $tenant = $this->getTenant($flagTenant);

        return $this->couponRepository->getCouponUrlByTenantId($tenant->id, $flagCoupon);
    }

    public function updateCoupon(array $data, string $flagTenant, string $flagCoupon)
    {
        $tenant = $this->getTenant($flagTenant);

        return $this->couponRepository->updateCouponByTenantId($tenant->id, $flagCoupon, $data);
    }

    public function deleteCoupon(string $flagTenant, string $flagCoupon)
    {
        $tenant = $this->getTenant($flagTenant);

        return $this->couponRepository->deleteCouponByTenantId($tenant->id, $flagCoupon);
    }

    public function verifyCoupon($flagTenant, $coupon)
    {
        $tenant = $this->getTenant($flagTenant);

        $coupon = $this->couponRepository->verifyCouponUrlByTenantId($tenant->id, $coupon);

        if (!$coupon)
            return false;

        return $coupon;

    }


    public function verifyCouponOrder($idTenant, $coupon)
    {
        $coupon = $this->couponRepository->verifyCouponUrlByTenantId($idTenant, $coupon);

        switch ($coupon->limit_mode)
        {
            case 'quantity':

                break;

            case 'price':
        }
    }

    public function getTenant($flagTenant)
    {
        if (!$tenant = $this->tenantRepository->getTenantByFlag($flagTenant))
            return false;

        return $tenant;
    }
}