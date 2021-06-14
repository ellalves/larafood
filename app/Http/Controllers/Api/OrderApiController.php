<?php

namespace App\Http\Controllers\Api;

use App\Events\OrderCreated;
use Illuminate\Http\Request;
use App\Services\OrderService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreOrder;
use App\Http\Resources\OrderResource;
use App\Http\Controllers\ApiController;

class OrderApiController extends ApiController
{
   protected $orderService;

   public function __construct(OrderService $orderService)
   {
       $this->orderService = $orderService;
   }

   public function myOrders()
   {
       try {
            $orders = $this->orderService->ordersByClient();
            return OrderResource::collection($orders);
       } catch (\Throwable $e) {
           //throw $e;
           return $this->errorResponse($e->getMessage());
       }
   }

   public function store(StoreOrder $request, $uuidTenant)
   {
       try {
            $order = $this->orderService->newOrder($request->all(), $uuidTenant);

            broadcast(new OrderCreated($order)); //Eviar notificação push

            return $this->successResponse(new OrderResource($order), null, 201);
        } catch (\Throwable $e) {
           return $this->errorResponse($e->getMessage());
        }
   }

   public function show($identify)
   {
       try {
           if (!$order = $this->orderService->getOrderByIdentify($identify)) {
                return $this->errorResponse(__('messages.empty_register'), 404);
           }
           return new OrderResource($order);
       } catch (\Throwable $e) {
           //throw $e;
           return $this->errorResponse($e->getMessage());
       } 
   }

//    public function show($uuidTenant, $identify)
//    {
//        try {
//            if (!$order = $this->orderService->getOrderByIdentify($identify)) {
//                 return $this->errorResponse(__('messages.empty_register'), 404);
//            }
//            return $this->successResponse(new OrderResource($order));
//        } catch (\Throwable $e) {
//            //throw $e;
//            return $this->errorResponse($e->getMessage());
//        } 
//    }
}
