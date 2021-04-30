<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;
use App\Services\ClientService;
use App\Http\Requests\Api\StoreClient;
use App\Http\Resources\ClientResource;
use App\Http\Controllers\ApiController;

class ClientController extends ApiController
{
    protected $clientService;

    public function __construct(ClientService $clientService)
    {
        $this->clientService = $clientService;
    }

    public function store(StoreClient $request)
    {
        try {
            $client = $this->clientService->newClient($request->all());
            return new ClientResource($client);
        } catch (\Throwable $e) {
            return $this->errorResponse($e->getMessage());
        }
    }
}
