<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EvaluationResource extends JsonResource
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
            "client" => new ClientResource($this->client),
            "order" => new OrderResource($this->order),
            "stars" => $this->stars,
            "comment" => $this->comment,
        ];
    }
}
