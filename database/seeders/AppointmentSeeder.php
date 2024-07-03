<?php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\Service;
use App\Models\Time;
use App\Models\User;
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
        $users = User::query()
            ->where('id', '>', 1)
            ->get();

        foreach($users as $user)
        {
            Appointment::factory(rand(1,3))->create([
                'user_id' => $user->id
            ]);
        }

        $appointments = Appointment::all()->shuffle();

        foreach ($appointments as $appointment)
        {
            $services = Service::query()
                ->inRandomOrder()
                ->take(rand(1, 3))
                ->get();

            /**
             * @var Appointment $appointment
             */
            $appointment->services()->attach($services);

            $times = Time::query()
                ->active()
                ->take(rand(1,7))
                ->get();

            $appointment->times()->attach($times);

            foreach ($times as $time)
            {
                $time->update(['count' => $time->count + 1]);
            }

        }

    }
}
