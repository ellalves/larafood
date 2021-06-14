<?php
namespace App\Repositories;

use Lecturize\Addresses\Models\Address;
use App\Repositories\Contracts\AddressRepositoryInterface;

class AddressRepository implements AddressRepositoryInterface 
{
    protected $entity;

    public function __construct(Address $address)
    {
        $this->entity = $address;
    }

    public function getAddressesByClient($client) 
    {
        $address = $client->addresses()
                                ->withoutGlobalScope(TenantScope::class)
                                ->orderBy('is_primary', 'desc')
                                ->paginate();
        return $address;
    }

    public function getAddressUuidByClient($uuidAddress, $client) 
    {
        $address = $client->addresses()
                                ->where('uuid', $uuidAddress)
                                ->withoutGlobalScope(TenantScope::class)
                                ->first();
        return $address;
    }

    public function addAddressByClient($data, $client) 
    {
        $address = $client->addresses()->first();
        return $client->addAddress($data);
    }

    public function updateAddressByClient($data, $uuidAddress, $client) 
    {
        $address = $client->addresses()->where('uuid', $uuidAddress)->first();
        $client->updateAddress($address, $data);
        return $address;        
    }

    public function deleteAddressByClient($uuidAddress, $client) 
    {
        $address = $client->addresses()->where('uuid', $uuidAddress)->first();
        return $client->deleteAddress($address);
    }

    public function deleteAllAddressByClient($uuidAddress, $client) 
    {
        return $client->flushAddresses();
    }
}