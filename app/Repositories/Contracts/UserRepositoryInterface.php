<?php
namespace App\Repositories\Contracts;

interface UserRepositoryInterface
{
    // public function createUser(array $data);
    public function searchUser(int $idTenant, string $filter);
    public function getUserUuidByTenantId(int $idTenant, string $uuidUser);
}