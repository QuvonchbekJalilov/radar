<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FavouriteResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id, // Assuming user_id is directly accessible
            'user' => new UserResource($this->whenLoaded('user')), // Transform user relationship
            'product_id' => $this->product_id, // Assuming product_id is directly accessible
            'product' => new ProductResource($this->whenLoaded('product')), 
        ];
    }
}
