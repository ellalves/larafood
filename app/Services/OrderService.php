<?php
namespace App\Services;

use App\Models\Order;
use App\Repositories\Contracts\OrderRepositoryInterface;
use App\Repositories\Contracts\ProductRepositoryInterface;
use App\Repositories\Contracts\TableRepositoryInterface;
use App\Repositories\Contracts\TenantRepositoryInterface;

class OrderService
{
    protected $orderRepository, $tenantRepository, $tableRepository, $productRepository;

    public function __construct(
        OrderRepositoryInterface $orderRepository,
        TenantRepositoryInterface $tenantRepository,
        TableRepositoryInterface $tableRepository,
        ProductRepositoryInterface $productRepository
    )
    {
        $this->orderRepository = $orderRepository;
        $this->tenantRepository = $tenantRepository;
        $this->tableRepository = $tableRepository;
        $this->productRepository = $productRepository;
    }

    public function newOrder(array $order, $uuidTenant)
    {
        $identify = $this->getIdentifyOrder();
        // dd($order);
        $status = 'open';
        $tenantId = $this->getTenantIdByOrder($uuidTenant);
        $productsOrder = $this->getProductsByOrder($tenantId, $order['products'] ?? []);
        $total = $this->getTotalOrder($productsOrder);
        $comment = isset($order['comment']) ? $order['comment'] : '';
        $clientId = $this->getClientOrder();
        $tableId = $this->getTableIdByOrder($tenantId, $order['table'] ?? '');

        $order = $this->orderRepository->newOrder(
            $identify,
            $total,
            $status,
            $tenantId,
            $comment,
            $clientId,
            $tableId,
        );
        
        $this->orderRepository->registerProductsOrder($order->id, $productsOrder);

        return $order;
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
    
    /**
     * Privados
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

    private function getProductsByOrder($uuidTenant, array $productsOrder): array
    {
        $products = [];
        foreach ($productsOrder as $productOrder) {
            $product = $this->productRepository->getProductByUuid($uuidTenant, $productOrder['identify']);

            array_push($products, [
                'id' => $product->id,
                'qty' => $productOrder['qty'],
                'price' => $product->price,
            ]);
        }

        return $products;
    }
    
}