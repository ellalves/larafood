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
            "route" => $this->route,
            "street" => $this->street,
            "number" => $this->street_number,
            "city" => $this->city,
            "state" => $this->state,
            "street_extra" => $this->street_extra,
            "notes" => $this->notes,
            "lat" => $this->lat,
            "lng" => $this->lng,
            "post_code" => $this->post_code,
            "country" => $this->country_code,
            "is_primary" => $this->is_primary
        ];
    }
}
