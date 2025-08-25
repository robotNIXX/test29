<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Cars\Create;
use App\Http\Resources\Api\CarResource;
use App\Models\Car;
use App\Services\CarService;
use Illuminate\Auth\Access\Gate;
use Illuminate\Auth\Access\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CarsController extends Controller
{
    //
    public function __construct(
        private CarService $carService,
    )
    {

    }

    public function index(Request $request) {
        $where = [];
        $sort = $request->get('sort', []);
        if ($request->has('filter')) {
            foreach ($request->get('filter') as $key => $value) {
                $where[$key] = $value;
            }
        }
        $records = $this->carService->list($where, $sort);

        return CarResource::collection($records);
    }

    public function get(int $id): CarResource {
        $record = $this->carService->get($id);

        return new CarResource($record);
    }

    public function update(Request $request, int $id): CarResource | Response {
        $record = $this->carService->update($id, $request->all());

        return new CarResource($record);
    }

    public function store(Create $request): CarResource {
        $user = $request->user();
        $record = $this->carService->create($user, $request->all());

        return new CarResource($record);
    }

    public function delete(int $id): JsonResponse | Response {
        $this->carService->delete($id);
        return response()->json([
            'success' => true,
        ]);
    }
}
