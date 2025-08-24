<?php

namespace Database\Seeders;

use App\Models\CarBrand;
use App\Models\CarModel;
use Database\Factories\CarBrandFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use SebastianBergmann\Environment\Console;
use Throwable;

class CarBrandsAndModelsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        try {
            $fileContent = File::json(Storage::path('/private/cars.json'));
            if (count($fileContent) > 0) {
                foreach($fileContent as $brand) {
                    $brandRecord = CarBrand::factory()
                        ->create([
                            'title' => $brand['cyrillic_name'],
                        ]);
                    
                    if (count($brand['models']) > 0) {
                        foreach($brand['models'] as $model) {
                            CarModel::factory()
                            ->for($brandRecord)
                            ->create([
                                'title' => $model['cyrillic_name'],
                            ]);
                        }
                    }
                }
            }
        } catch (Throwable $throw) {
            Log::error("ERROR: " . $throw->getMessage());
        }
    }
}
