<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setting::query()->create([
            'company_name' => 'Fateme Atefrad',
            'working_time' => [
                'opening_time' => '09',
                'closing_time' => '21'
            ],
            'time_slot_duration' => 15
        ]);
    }
}
