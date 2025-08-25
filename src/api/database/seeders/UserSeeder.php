<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Test29',
            'email' => 'test29@email.com',
            'password' => Hash::make('12345678'),
        ]);
        User::factory()->create([
            'name' => 'Test29_1',
            'email' => 'test29_1@email.com',
            'password' => Hash::make('12345678'),
        ]);
    }
}
