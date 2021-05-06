<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'identify' => $this->identify,
            'total' => $this->total,
            'status' => $this->status,
            'message' => $this->comment,
            'products' => ProductResource::collection($this->products),
            'client' => new ClientResource($this->client),
            'table' => new TableResource($this->table),
            'tenant' => new TenantResource($this->tenant)
        ];
    }
}
