<?php 
namespace App\Services;

use App\Repositories\Contracts\AddressRepositoryInterface;

class AddressService 
{
    protected $addressRepository;

    public function __construct(AddressRepositoryInterface $addressRepository)
    {
        $this->addressRepository = $addressRepository;
    }

    public function getAddressesByClient()
    {
        return $this->addressRepository->getAddressesByClient($this->client());
    }

    public function getAddressByClient($uuidAddress)
    {
        return $this->addressRepository->getAddressUuidByClient($uuidAddress, $this->client());
    }

    public function addAddressByClient($data)
    {
        return $this->addressRepository->addAddressByClient($data, $this->client());
    }

    public function updateAddressByClient($data, $uuidAddress)
    {
        return $this->addressRepository->updateAddressByClient($data, $uuidAddress, $this->client());
    }

    public function deleteAddressByClient($uuidAddress)
    {
        return $this->addressRepository->deleteAddressByClient($uuidAddress, $this->client());
    }

    public function client()
    {
        return auth()->user();
    }
}