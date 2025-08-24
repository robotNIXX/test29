<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\API\CarBrandResource;
use App\Services\CarBrandService;
use Illuminate\Http\Request;

class CarBrandsController extends Controller
{

    public function __construct(
        private CarBrandService $cardBrandService
    )
    {
        
    }

    /**
     * List of brands
     */
    public function index() {
        $records = $this->cardBrandService->list();

        return CarBrandResource::collection($records);
    }
}
