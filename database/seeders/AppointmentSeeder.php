<?php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\Service;
use App\Models\Time;
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
            $services = Service::query()
                ->inRandomOrder()
                ->take(rand(1, 3))
                ->get();

            foreach ($services as $service)
            {
                DB::table('appointment_service')->insert([

                    'appointment_id' => $appointment->id,
                    'service_id' => $service->id,
                    'created_at' => Carbon::now()
            ]);
            }

            $times = Time::query()
                ->active()
                ->take(rand(1,7))
                ->get();

            foreach ($times as $time)
            {
                $time->update(['count' => $time->count + 1]);

                DB::table('appointment_time')->insert([

                    'appointment_id' => $appointment->id,
                    'time_id' => $time->id,
                     'created_at' => Carbon::now()
            ]);
            }

        }

    }
}
