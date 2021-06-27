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

        $this->verifyIsPrimary($data['is_primary'], $client);
        return $client->addAddress($data);
    }

    public function updateAddressByClient($data, $uuidAddress, $client) 
    {
        $this->verifyIsPrimary($data['is_primary'], $client);

        $address = $client->addresses()->where('uuid', $uuidAddress)->first();
        $client->updateAddress($address, $data);
        return $address;        
    }

    public function deleteAddressByClient($uuidAddress, $client) 
    {
        $address = $client->addresses()->where('uuid', $uuidAddress)->first();
        return $address->forceDelete(); // $client->deleteAddress($address);
    }

    public function deleteAllAddressByClient($uuidAddress, $client) 
    {
        return $client->flushAddresses();
    }

    private function verifyIsPrimary($flag, $client)
    {
        if(!empty($flag) && $flag == 1) {
            $client->addresses()->where('is_primary', 1)
                    ->update(['is_primary' => 0]);
        }
    }
}