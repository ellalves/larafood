<?php
namespace App\Repositories\Contracts;

interface AddressRepositoryInterface 
{
    public function getAddressesByClient($client);
    public function getAddressUuidByClient($uuidAddress, $client);
    public function addAddressByClient($data, $client);
    public function updateAddressByClient($data, $uuidAddress, $client);
    public function deleteAddressByClient($uuidAddress, $client);
    public function deleteAllAddressByClient($uuidAddress, $client);
} 