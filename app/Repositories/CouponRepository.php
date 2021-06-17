<?php
namespace App\Repositories;

use App\Models\Coupon;
use App\Repositories\Contracts\CouponRepositoryInterface;

class CouponRepository implements CouponRepositoryInterface
{
    protected $entity;

    public function __construct(Coupon $coupon)
    {
        $this->entity = $coupon;
    }

    public function getCouponsByTenantId($idTenant)
    {
        $coupons = $this->entity->where('tenant_id', $idTenant)->paginate();
        return $coupons;
    }

    public function createCouponTenantId($idTenant, $data)
    {
        $data['tenant_id'] = $idTenant;
        return $this->entity->create($data);
    }

    public function getCouponUrlByTenantId($idTenant, $urlCoupon)
    {
        $coupon = $this->entity
                            ->where('tenant_id', $idTenant)
                            ->where('url', $urlCoupon)
                            ->first();

        return $coupon;
    }

    public function updateCouponByTenantId($idTenant, $urlCoupon, $data)
    {
        $coupon = $this->entity
                            ->where('url', $urlCoupon)
                            ->where('tenant_id', $idTenant)
                            ->first();

        $coupon->update($data);

        return $coupon;
    }

    public function deleteCouponByTenantId($idTenant, $urlCoupon)
    {
        $coupon = $this->entity
                            ->where('url', $urlCoupon)
                            ->where('tenant_id', $idTenant)
                            ->first();
                            
        return $coupon->delete();
    }

    public function verifyCouponUrlByTenantId($idTenant, $coupon)
    {
        return $this->entity
                        ->where('tenant_id', $idTenant)
                        ->where('start_validity', '<', now())
                        ->where('end_validity', '>', now())
                        ->where('url', '=', $coupon)
                        ->first();
    }
}