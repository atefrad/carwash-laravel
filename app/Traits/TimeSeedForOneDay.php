<?php

namespace App\Traits;

use App\Models\Setting;
use App\Models\Time;

trait TimeSeedForOneDay
{
    public function dailyTimeSeed($day): void
    {
        $workingTime = Setting::query()->first()->working_time;

        $opening_time = $workingTime['opening_time'];
        $closing_time = $workingTime['closing_time'];

        for ($i = $opening_time; $i < $closing_time; $i ++)
        {
            Time::query()->create([
                'start_time' => "0{$i}:00",
                'finish_time' => "0{$i}:15",
                'day' => $day->day,
                'month' => $day->month,
                'year' => $day->year,
                'count' => 0
            ]);

            Time::query()->create([
                'start_time' => "0{$i}:15",
                'finish_time' => "0{$i}:30",
                'day' => $day->day,
                'month' => $day->month,
                'year' => $day->year,
                'count' => 0
            ]);

            Time::query()->create([
                'start_time' => "0{$i}:30",
                'finish_time' => "0{$i}:45",
                'day' => $day->day,
                'month' => $day->month,
                'year' => $day->year,
                'count' => 0
            ]);

            Time::query()->create([
                'start_time' => "0{$i}:45",
                'finish_time' => $i + 1 . ":00",
                'day' => $day->day,
                'month' => $day->month,
                'year' => $day->year,
                'count' => 0
            ]);
        }
    }
}
