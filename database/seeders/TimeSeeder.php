<?php

namespace Database\Seeders;

use App\Models\Setting;
use App\Models\Time;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TimeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $stations = [1, 2];

        $today = Carbon::now();
        $tomorrow = $today->copy()->addDay();
        $dayAfterTomorrow = $tomorrow->copy()->addDay();

        $workingTime = Setting::query()->first()->working_time;

        $opening_time = $workingTime['opening_time'];
        $closing_time = $workingTime['closing_time'];

//        $todayDay = $today->day;
//        $todayMonth = $today->month;
//        $todayYear = $today->year;

        foreach($stations as $station)
        {
            $days = [$today, $tomorrow, $dayAfterTomorrow];

            foreach ($days as $day)
            {
                for ($i = $opening_time; $i < $closing_time; $i ++)
                {
                    Time::query()->create([
                        'station' => $station,
                        'start_time' => "0{$i}:00",
                        'finish_time' => "0{$i}:15",
                        'day' => $day->day,
                        'month' => $day->month,
                        'year' => $day->year,
                        'is_active' => 1
                    ]);

                    Time::query()->create([
                        'station' => $station,
                        'start_time' => "0{$i}:15",
                        'finish_time' => "0{$i}:30",
                        'day' => $day->day,
                        'month' => $day->month,
                        'year' => $day->year,
                        'is_active' => 1
                    ]);

                    Time::query()->create([
                        'station' => $station,
                        'start_time' => "0{$i}:30",
                        'finish_time' => "0{$i}:45",
                        'day' => $day->day,
                        'month' => $day->month,
                        'year' => $day->year,
                        'is_active' => 1
                    ]);

                    Time::query()->create([
                        'station' => $station,
                        'start_time' => "0{$i}:45",
                        'finish_time' => $i + 1 . ":00",
                        'day' => $day->day,
                        'month' => $day->month,
                        'year' => $day->year,
                        'is_active' => 1
                    ]);
                }

            }
        }
    }
}
