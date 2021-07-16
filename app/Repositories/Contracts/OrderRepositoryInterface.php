<?php
namespace App\Repositories\Contracts;

interface OrderRepositoryInterface
{
    public function newOrder(
        string $identify,
        float $total,
        float $totalPaid,
        float $totalDiscount,
        string $status,
        int $tenantId,
        string $address,
        int $formPaymentId,
        float $shipping,
        float $totalChange,
        string $comment = '',
        $clientId = '',
        $tableId = '',
        $deliverymanId = '',
        $seller = ''
    );
    public function getOrderByIdentify(string $identify);
    public function registerProductsOrder(int $orderId, array $products);
    public function getOrdersByClientId(int $idClient);
    public function getOrdersByTenantId(int $idTenant, string $status, string $date = null);
    public function updateStatusOrder(string $identify, string $status);
    public function verifyLimitMode($coupon);
}