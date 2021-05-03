<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'identify' => $this->uuid, 
            'title'=> $this->title,
            'flag'=>  $this->url,
            'image'=> url("/storage/{$this->image}"),
            'price'=> $this->price,
            'description' => $this->description,
            'categories' => CategoryResource::collection($this->categories),
        ];
    }
}
