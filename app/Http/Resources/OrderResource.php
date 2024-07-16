<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'user' => new UserResource($this->user), // Use the relationship directly
            'address' => new UserAddressResource($this->address), // Assuming AddressResource is defined correctly
            'products' => ProductResource::collection($this->products),
            'total_amount' => $this->total_amount,
            'payment_method' => $this->payment_method,
            'shipping_method' => $this->shipping_method,
            'payment_status' => $this->payment_status,
            'shipping_status' => $this->shipping_status,
            'status' => $this->status,
            'order_date' => $this->order_date,
        ];
    }
}
