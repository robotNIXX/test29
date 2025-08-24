<?php

namespace App\Services;

use App\Models\CarBrand;

class CarBrandService {

    /**
     * List of brands
     */
    public function list() {
        return CarBrand::orderBy('title', 'ASC')->get();
    }
}