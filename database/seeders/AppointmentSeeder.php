<?php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AppointmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $appointments = Appointment::factory(10)->create();

        foreach ($appointments as $appointment)
        {
            $services = Service::query()->inRandomOrder()->take(rand(1, 3))->get()->pluck('id');

            foreach ($services as $service)
            {
                DB::table('service_appointment')->insert([

                    'appointment_id' => $appointment->id,
                    'service_id' => $service,
                    'created_at' => Carbon::now()
            ]);
            }

        }

    }
}
