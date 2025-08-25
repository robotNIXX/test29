<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CarResource extends JsonResource
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
            'color' => $this->color ?? 'No color',
            'mileage' => $this->mileage ?? 'No mileage',
            'year' => $this->year ?? 'No year',
            'brand' => $this->brand->title,
            'model' => $this->model->title,
            'owner' => $this->owner->name,
        ];
    }
}
