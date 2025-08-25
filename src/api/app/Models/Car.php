<?php

namespace App\Models;

use App\Policies\CarPolicy;
use Illuminate\Database\Eloquent\Attributes\UsePolicy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[UsePolicy(CarPolicy::class)]
class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'brand_id',
        'model_id',
        'production_year',
        'mileage',
        'color',
    ];

    public function owner() {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function brand() {
        return $this->belongsTo(CarBrand::class, 'brand_id');
    }

    public function model() {
        return $this->belongsTo(CarModel::class, 'model_id');
    }
}
