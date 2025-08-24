<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\API\CarModelResource;
use App\Services\CarModelService;
use Illuminate\Http\Request;

class CarModelsController extends Controller
{
    public function __construct(
        private CarModelService $carModelService
    )
    {
        
    }

    /**
     * List of models
     */
    public function index(Request $request) {
        $records = $this->carModelService->list();

        return CarModelResource::collection($records);
    }
}
