<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarBrand extends Model
{
    use HasFactory;

    public function models() {
        return $this->hasMany(CarModel::class, 'brand_id');
    }
}
