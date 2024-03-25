<?php

namespace Database\Seeders;

use App\Models\Setting;
use App\Models\Time;
use App\Traits\TimeSeedForOneDay;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TimeSeeder extends Seeder
{
    use TimeSeedForOneDay;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $today = Carbon::now();
        $tomorrow = $today->copy()->addDay();
        $dayAfterTomorrow = $tomorrow->copy()->addDay();

        $days = [$today, $tomorrow, $dayAfterTomorrow];

        foreach ($days as $day)
        {
            $this->dailyTimeSeed($day);
        }
    }

}
