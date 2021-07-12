<?php
namespace App\Repositories\Contracts;

interface UserRepositoryInterface
{
    // public function createUser(array $data);
    // public function getUser(string $uuid);
    public function searchUser(int $idTenant, string $filter);
}