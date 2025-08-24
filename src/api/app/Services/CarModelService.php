<?php

namespace App\Services;

use App\Models\CarModel;

class CarModelService {
    public function list(?int $brandId = null) {
        if ($brandId) {
            return CarModel::where('brand_id', $brandId)->orderBy('title', 'asc')->get();
        }
        return CarModel::orderBy('title', 'asc')->get();
    }
}