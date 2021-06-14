<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AddressResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "identify" => $this->uuid,
            "street" => $this->route,
            "number" => $this->street_number,
            "city" => $this->city,
            "state" => $this->state,
            "district" => $this->street_extra,
            "complement" => $this->notes,
            "lat" => $this->lat,
            "lng" => $this->lng,
            "cep" => $this->post_code,
            "country" => $this->country_name,
            "is_primary" => $this->is_primary
        ];
    }
}
