<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BrandResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'title_uz' => $this->title_uz,
            'title_ru' => $this->title_ru,
            'title_en' => $this->title_en,
            'description_uz' => $this->description_uz,
            'description_ru' => $this->description_ru,
            'description_en' => $this->description_en,
            'image' => "https://www.work.dora.uz/public/storage/".$this->image,
        ];
    }
}
