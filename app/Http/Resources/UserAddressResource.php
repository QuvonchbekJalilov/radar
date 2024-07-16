<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserAddressResource extends JsonResource
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
            'longitude' => $this->longitude,
            'latitude' => $this->latitude,
            'region' => $this->region,
            'district' => $this->district,
            'street' => $this->street,
            'home' => $this->home, 

        ];
    }
}
