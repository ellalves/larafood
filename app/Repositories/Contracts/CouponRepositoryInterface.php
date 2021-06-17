<?php
namespace App\Repositories\Contracts;

interface CouponRepositoryInterface
{
    public function getCouponsByTenantId(int $idTenant);
    public function createCouponTenantId(int $idTenant, array $data);
    public function updateCouponByTenantId(int $idTenant, string $flagCoupon, array $data);
    public function getCouponUrlByTenantId(int $idTenant, string $flagCoupon);
    public function deleteCouponByTenantId(int $idTenant, string $flagCoupon);
    public function verifyCouponUrlByTenantId(int $idTenant, string $coupon);
    // public function verifyCouponUrlByTenantUuid(string $uuidTenant, string $coupon);
}