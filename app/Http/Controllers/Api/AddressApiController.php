<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Services\AddressService;
use App\Http\Controllers\ApiController;
use App\Http\Resources\AddressResource;
use App\Http\Requests\Api\StoreUpdateAddress;

class AddressApiController extends ApiController
{
    protected $addressService;

    public function __construct(AddressService $addressService)
    {
        $this->addressService = $addressService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {

            $addresses = $this->addressService->getAddressesByClient();
            return AddressResource::collection($addresses);

        } catch (\Throwable $e) {
            return $this->errorResponse($e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\StoreUpdateAddress $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateAddress $request)
    {
        try {

            $address = $this->addressService->addAddressByClient($request->all());
            return new AddressResource($address);

        } catch (\Throwable $e) {
            return $this->errorResponse($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($uuidAddress)
    {
        try {

            $address = $this->addressService->getAddressByClient($uuidAddress);
            return new AddressResource($address);

        } catch (\Throwable $e) {
            return $this->errorResponse($e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $uuidAddress)
    {
        try {

            $address = $this->addressService->updateAddressByClient($request->all(), $uuidAddress);
            return new AddressResource($address);

        } catch (\Throwable $e) {
            return $this->errorResponse($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($uuidAddress)
    {
        try {

            $address = $this->addressService->deleteAddressByClient($uuidAddress);
            return $this->successResponse($address);

        } catch (\Throwable $e) {
            return $this->errorResponse($e->getMessage());
        }
    }
}
