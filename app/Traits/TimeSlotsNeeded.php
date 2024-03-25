<?php

namespace App\Traits;

use App\Models\Service;
use App\Models\Setting;

trait TimeSlotsNeeded
{
    public function calculateTimeSlotsNeeded($services): float|int
    {
        $serviceDuration = 0;

        foreach ($services as $serviceId)
        {
            $serviceDuration += Service::query()->find($serviceId)->duration;
        }

        $timeSlotDuration = Setting::query()->first()->time_slot_duration;

        return $serviceDuration/$timeSlotDuration;
    }
}
