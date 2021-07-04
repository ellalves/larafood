<?php
namespace App\Services;

use App\Repositories\ClientRepository;

class ClientService
{
    protected $clientRepository;

    public function __construct(ClientRepository $clientRepository)
    {
        $this->clientRepository = $clientRepository;
    }

    public function newClient($data)
    {
        return $this->clientRepository->createClient($data);
    }

    public function searchClient($filter)
    {
        return $this->clientRepository->searchClient($filter);
    }
}