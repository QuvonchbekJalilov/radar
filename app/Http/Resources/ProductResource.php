<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'category' => new CategoryResource($this->category), // Use the relationship directly
            'brand_id' => new BrandResource($this->brand), // Use the relationship directly
            'name_uz' => $this->name_uz, 
            'name_ru' => $this->name_ru, 
            'name_en' => $this->name_en,
            'description_uz' => $this->description_uz, 
            'description_ru' => $this->description_ru, 
            'description_en' => $this->description_en, 
            'price' => $this->price, 
            'stock' => $this->stock, 
            'image' => "https://www.work.dora.uz/public/storage/".$this->image, 
            'status' => $this->status,
        ];
    }
}
