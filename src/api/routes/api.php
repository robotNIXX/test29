<?php

use App\Http\Controllers\Api\CarBrandsController;
use App\Http\Controllers\Api\CarModelsController;
use App\Http\Controllers\Api\CarsController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\LogoutController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('/logout', [LogoutController::class, 'logout']);
//    cars
    Route::group(['prefix' => 'cars'], function () {
        Route::post('/', [CarsController::class, 'store'])->name('cars.create');
        Route::get('/{id}', [CarsController::class, 'get'])->name('cars.item');
        Route::put('/{id}', [CarsController::class, 'update'])->name('cars.update');
        Route::delete('/{id}', [CarsController::class, 'delete'])->name('cars.destroy');
    });
});
Route::get('/models', [CarModelsController::class, 'index'])->name('models.list');
Route::get('/brands', [CarBrandsController::class, 'index'])->name('brands.list');
Route::get('/cars', [CarsController::class, 'index'])->name('cars.list');
Route::post('/login', [LoginController::class, 'login'])->name('login');
