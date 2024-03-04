<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Service::query()->create([
                'name' => 'exterior wash',
                'duration' => 15,
                'price' => 25000
        ]);

        Service::query()->create([
            'name' => 'interior cleaning',
            'duration' => 30,
            'price' => 30000
        ]);

        Service::query()->create([
            'name' => 'full service',
            'duration' => 60,
            'price' => 80000
        ]);
    }
}
