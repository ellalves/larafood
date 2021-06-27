<?php
namespace App\Services;

use App\Models\Order;
use Illuminate\Support\Facades\DB;
use App\Repositories\Contracts\OrderRepositoryInterface;
use App\Repositories\Contracts\TableRepositoryInterface;
use App\Repositories\Contracts\CouponRepositoryInterface;
use App\Repositories\Contracts\TenantRepositoryInterface;
use App\Repositories\Contracts\ProductRepositoryInterface;

class OrderService
{
    protected $orderRepository, $tenantRepository, $tableRepository, $productRepository, $couponRepository;

    public function __construct(
        OrderRepositoryInterface $orderRepository,
        TenantRepositoryInterface $tenantRepository,
        TableRepositoryInterface $tableRepository,
        ProductRepositoryInterface $productRepository,
        CouponRepositoryInterface $couponRepository
    )
    {
        $this->orderRepository = $orderRepository;
        $this->tenantRepository = $tenantRepository;
        $this->tableRepository = $tableRepository;
        $this->productRepository = $productRepository;
        $this->couponRepository = $couponRepository;
    }

    public function newOrder(array $order, $uuidTenant)
    {
        $identify = $this->getIdentifyOrder();
        $status = 'open';
        $tenantId = $this->getTenantIdByOrder($uuidTenant);
        $productsOrder = $this->getProductsByOrder($tenantId, $order['products'] ?? []);
        $total = $this->getTotalOrder($productsOrder);
        $totalPaid = $this->getTotalPaidOrder($productsOrder);
        $totalDiscount = $this->getTotalDiscountOrder($productsOrder);
        $address = $order['address'];
        $formPaymentId = $order['form_payment_id'];
        $comment = isset($order['comment']) ? $order['comment'] : '';
        $clientId = $this->getClientOrder();
        $tableId = $this->getTableIdByOrder($tenantId, $order['table'] ?? '');

        //begin Database Transaction
        // DB::beginTransaction();

        $order = $this->orderRepository->newOrder(
            $identify,
            $total,
            $totalPaid,
            $totalDiscount,
            $status,
            $tenantId,
            $address,
            $formPaymentId,
            $comment,
            $clientId,
            $tableId,
        );
        
        $this->orderRepository->registerProductsOrder($order->id, $productsOrder);

        return $order;

        // if ($order && $products)
        // {
        //     //Success
        //     DB::commit();
            
        //     return $order;
        // }

        //Fail, undo database changes
        // DB::rollBack();

        // return false;
    }

    public function getOrderByIdentify($identify)
    {
        return $this->orderRepository->getOrderByIdentify($identify);
    }

    public function ordersByClient()
    {
        $idClient = $this->getClientOrder();

        return $this->orderRepository->getOrdersByClientId($idClient);
    }

    public function getTenantIdByOrder(string $uuidTenant)
    {
        if ($tenant = $this->tenantRepository->getTenantByUuid($uuidTenant)) {
            return $tenant->id;
        }

        return false;
    }

    public function getOrdersByTenantId(int $idTenant, string $status, string $date)
    {
        return $this->orderRepository->getOrdersByTenantId($idTenant, $status, $date);
    }

    public function updateStatusOrder(string $identify, string $status)
    {
        return $this->orderRepository->updateStatusOrder($identify, $status);
    }
    
    /**
     * Privates
     */

    private function getIdentifyOrder(int $qtyCaracters = 8)
    {
        $smallLetters = str_shuffle('abcdefghijklmnopqrstuvwxyz');

        $numbers = (((date('Ymd') / 12) * 24) + mt_rand(800, 9999));
        $numbers .= 1234567890;

        // $specialCharacters = str_shuffle('!@#$%*-');

        // $characters = $smallLetters.$numbers.$specialCharacters;
        $characters = $smallLetters.$numbers;

        $identify = substr(str_shuffle($characters), 0, $qtyCaracters);

        if ($this->orderRepository->getOrderByIdentify($identify)) {
            $this->getIdentifyOrder($qtyCaracters + 1);
        }

        return $identify;
    }

    private function getTableIdByOrder(int $uuidTenant, string $identify)
    {
        if ($uuidTenant && $identify) {
            $table = $this->tableRepository->getTableIdentifyByTenantId($uuidTenant, $identify);

            return $table->id;
        }

        return 0;
    }

    private function getClientOrder()
    {
        $client = auth()->check() ? auth()->user()->id : null;

        return $client;
    }

    private function getTotalOrder(array $products)
    {
        $total = 0;

        foreach ($products as $product) {
            $total += ($product['price'] * $product['qty']);
        }

        return $total;
    }

    private function getTotalPaidOrder(array $products)
    {
        $totalPaid = 0;

        foreach ($products as $product) {
            $totalPaid += ($product['price'] - $product['discount']);
        }

        return $totalPaid;
    }

    private function getTotalDiscountOrder($products)
    {
        $totalDiscount= 0;

        foreach ($products as $product) {
            $totalDiscount += $product['discount'];
        }

        return $totalDiscount;
    }

    private function getProductsByOrder($idTenant, array $productsOrder): array
    {
        if (array_key_exists('coupon', $productsOrder[0])) 
        {
            $coupon = $this->couponRepository->verifyCouponUrlByTenantId($idTenant, $productsOrder[0]['coupon']);
        }

        if(!empty($coupon))
        {
            $numberOfCouponsUsed = $this->orderRepository->verifyLimitMode($coupon);

            $limitCoupons = $this->getCouponLimitOrder($coupon, $numberOfCouponsUsed);
        }
 
        $products = [];
        foreach ($productsOrder as $productOrder) {
            $product = $this->productRepository->getProductByUuid($idTenant, $productOrder['identify']);

            if (!empty($coupon))
            {
                $discount = $this->getDiscountOrder($coupon, $product, $productOrder['qty']);
                $paid = $product->price - $discount;
            }

            array_push($products, [
                'id' => $product->id,
                'qty' => $productOrder['qty'],
                'price' => $product->price,
                'paid' =>  $paid ?? "0.00",
                'discount' => $discount ?? "0.00",
                'coupon' => $coupon->url ?? null,
            ]);
        }

        return $products;
    }
    
    private function getDiscountOrder($coupon, $product, $qty)
    {
        switch ($coupon->discount_mode)
        {
            case 'percentage':
                $discount = $qty * ($coupon->discount * $product->price) / 100;
                break;
            
            case 'price':
                $discount = ($product->price > $coupon->discount) ? $coupon->discount : $product->price;
                break;
            
            default: 
                $discount = 0.00;
        }

        return $discount;
    }

    private function getCouponLimitOrder($coupon, $numberOfCouponsUsed)
    {
        switch ($coupon->limit_mode)
        {
            case 'quantity':
                if( count( $numberOfCouponsUsed['coupons'] ) >= $coupon->limit ) {
                    return false;
                }
                break;
                
            case 'price':
                if( array_sum( $numberOfCouponsUsed['discounts'] ) > $coupon->limit ) {
                    return false;
                }                
                break;
        }
    }
}