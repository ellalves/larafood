<?php

namespace App\Http\Resources;

use Carbon\Carbon;
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
            'total_discount' => $this->total_discount,
            'status' => $this->status,
            'status_label' => $this->statusOptions[$this->status],
            'message' => $this->comment,
            'create' => Carbon::make($this->created_at)->format('Y-m-d H:i:s'),
            'products' => ProductResource::collection($this->products),
            'client' => new ClientResource($this->client),
            'table' => new TableResource($this->table),
            'company' => new TenantResource($this->tenant),
            'evaluations' => EvaluationResource::collection($this->evaluations)
        ];
    }
}
