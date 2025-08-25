<?php

namespace App\Services;

use App\Models\Car;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Gate;

class CarService
{
    public function list(?array $filter, ?array $sort): Collection
    {
        $where = [];
        $order = [];
        if (!empty($filter)) {
            foreach ($filter as $field => $value) {
                $where[] = [$field, '=', $value];
            }
        }
        if (!empty($sort)) {
            foreach ($sort as $field => $direction) {
                $order[$field] = $direction;
            }
        } else {
            $order = ['id' => 'asc'];
        }

        $query = Car::query()->where($where);
        foreach ($order as $field => $direction) {
            $query->orderBy($field, $direction);
        }

        return $query->get();
    }

    public function create(User $user, array $data): Car {
        return $user->cars()->create($data);
    }

    public function update(int $carId, array $data): Car {
        $car = Car::find($carId);

        Gate::authorize('update', $car);
        $car->update($data);

        return Car::find($carId);
    }

    public function delete(int $carId): bool {
        $car = Car::find($carId);
        Gate::authorize('update', $car);

        return $car->delete();
    }

    public function get (int $carId): Car {
        return Car::find($carId);
    }
}
