<?php
namespace App\Repositories;

use App\Models\Order;
use App\Repositories\Contracts\OrderRepositoryInterface;

class OrderRepository implements OrderRepositoryInterface
{
    protected $entity;

    public function __construct(Order $order)
    {
        $this->entity = $order;
    }

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
        float $totalChange = 0,
        string $comment = '',
        $clientId = '',
        $tableId = '',
        $deliverymanId = '',
        $sellerId = ''
    )
    {
        $data = [
            'identify' => $identify,
            'total' => $total,
            'total_paid' => $totalPaid,
            'total_discount' => $totalDiscount,
            'status' => $status,
            'tenant_id' => $tenantId,
            'address' => $address,
            'form_payment_id' => $formPaymentId,
            'shipping' => $shipping,
            'comment' => $comment,
            // 'client_id' => $clientId,
            // 'table_id' => $tableId,
        ];

        if($clientId != 0) $data['client_id'] = $clientId;
        if($tableId != '') $data['table_id'] = $tableId;
        if($deliverymanId != '') $data['deliveryman'] = $deliverymanId;
        if($sellerId != '') $data['seller'] = $sellerId;
        if($totalChange != 0) $data['total_change'] = $totalChange;
// dd($data);
        $order = $this->entity->create($data);

        return $order;
    }

    public function getOrderByIdentify(string $identify)
    {
        if (!$order = $this->entity->where('identify', $identify)->first())
            return false;

        return $order;
    }

    public function registerProductsOrder(int $orderId, array $products)
    {

        $order = $this->entity->find($orderId);

        foreach($products as $product) {
            $data[] = $order->products()->attach($product['id'], [
                'price'     => $product['price'],
                'qty'       => $product['qty'],
                'discount'  => $product['discount'],
                'paid'      => $product['paid'],
                'coupon'    => $product['coupon'] ?? null,
            ]);
        }

    }

    public function getOrdersByClientId(int $idClient)
    {
        $orders = $this->entity
                            ->where('client_id', $idClient)
                            ->paginate();
        return $orders;
    }

    public function getOrdersByTenantId(int $idTenant, string $status, string $date = null)
    {
        $orders = $this->entity
                        ->where('tenant_id', $idTenant)
                        ->where(function ($query) use ($status) {
                            if ($status != 'all') {
                                return $query->where('status', $status);
                            }
                        })
                        ->where(function ($query) use ($date) {
                            if ($date) {
                                return $query->whereDate('created_at', $date);
                            }
                        })
                        ->get();

        return $orders;
    }

    public function updateStatusOrder(string $identify, string $status)
    {
        $this->entity->where('identify', $identify)->update(['status' => $status]);

        return $this->entity->where('identify', $identify)->first();
    }

    public function verifyLimitMode($coupon)
    {
        $orders = $this->entity->whereIn('status', ['done', 'working', 'open'])->get();

        $coupons = $discounts = [];
        foreach ($orders as $order) {
            foreach ($order->products as $product) {
                $coupons[] = $product->pivot->coupon;
                $discounts[] = $product->pivot->discount;
            }

        }

        return [
            'coupons' => $coupons,
            'discounts' => $discounts
        ];
    }
}
