<?php
namespace App\Repositories\Contracts;

interface ClientRepositoryInterface
{
    public function createClient(array $data);
    public function getClient(string $uuid);
    public function searchClient(string $filter);
}