<?php

namespace App\Http\Resources\API;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CarModelResource extends JsonResource
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
            'title' => $this->title,
            'brand' => CarBrandResource::make($this->carBrand),
        ];
    }
}
