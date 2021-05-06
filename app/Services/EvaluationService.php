<?php
namespace App\Services;

use App\Repositories\Contracts\EvaluationRepositoryInterface;
use App\Repositories\Contracts\OrderRepositoryInterface;

class EvaluationService
{
    protected $evaluationRepository, $orderRepository;

    public function __construct(
        EvaluationRepositoryInterface $evaluationRepository,
        OrderRepositoryInterface $orderRepository)
    {
        $this->evaluationRepository = $evaluationRepository;
        $this->orderRepository = $orderRepository;
    }

    public function newEvaluationOrder(string $identifyOrder, array $evaluation)
    {
        $idClient = $this->getIdClient();

        $order = $this->orderRepository->getOrderByIdentify($identifyOrder);

        return $this->evaluationRepository->newEvaluationOrder($order->id, $idClient, $evaluation);
    }


    private function getIdClient()
    {
        $client = auth()->check() ? auth()->user()->id : 0;

        return $client;
    }
}