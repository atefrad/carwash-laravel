<?php

namespace App\Http\Controllers;

use App\Models\Time;
use App\Traits\TimeSlotsNeeded;

class TimeController extends Controller
{
    use TimeSlotsNeeded;

    public function index()
    {
        if(empty($_GET['service_id']))
        {
            return response()->json(['error' => 'Please select services first!']);
        }

        $servicesId = explode(' ', $_GET['service_id']);

        $timeSlotsNeeded = $this->calculateTimeSlotsNeeded($servicesId);

        $times = Time::query()
            ->newTimeSlots()
            ->active()
            ->get();

        if ($timeSlotsNeeded === 1)
        {
            return response()->json($times);
        }

        $availableTimeSlots[0] = [$times[0]];

        $k = 0;

        for($i = 1; $i <  count($times); $i++)
        {
            if($times[$i]->start_time !== $times[$i - 1]->finish_time)
            {
                $availableTimeSlots[$k] = [];
            }
            $availableTimeSlots[$k][] = $times[$i];

            if(count($availableTimeSlots[$k]) === $timeSlotsNeeded)
            {
                $k++;
            }
        }

        if(count(last($availableTimeSlots)) !== $timeSlotsNeeded)
        {
            array_pop($availableTimeSlots);
        }

        return response()->json($availableTimeSlots);

    }

    public function show()
    {
        if(empty($_GET['service_id']))
        {
            return response()->json(['error' => 'Please select services first!']);
        }

        $servicesId = explode(' ', $_GET['service_id']);

        $timeSlotsNeeded = $this->calculateTimeSlotsNeeded($servicesId);

        $times = Time::query()
            ->newTimeSlots()
            ->active()
            ->get();

        $fastestTimeSlots = [$times[0]];

        for($i = 1; $i <  count($times); $i++)
        {
            if(count($fastestTimeSlots) === $timeSlotsNeeded)
            {
                break;
            }

            if($times[$i]->start_time !== $times[$i - 1]->finish_time)
            {
                $fastestTimeSlots = [];
            }
            $fastestTimeSlots[] = $times[$i];
        }

        return response()->json($fastestTimeSlots);
    }
}
