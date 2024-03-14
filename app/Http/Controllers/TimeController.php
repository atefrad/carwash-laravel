<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Setting;
use App\Models\Time;
use Illuminate\Http\Request;

class TimeController extends Controller
{
    public function index()
    {
        if(empty($_GET['service_id']))
        {
            return response()->json(['error' => 'Please select services first!']);
        }

        $servicesId = explode(' ', $_GET['service_id']);

        $serviceDuration = 0;

        foreach ($servicesId as $serviceId)
        {
            $serviceDuration += Service::query()->find($serviceId)->duration;
        }

        $times = Time::query()
            ->newTimeSlots()
            ->active()
            ->get();

        $timeSlotDuration = Setting::query()->first()->time_slot_duration;

        $timeSlotsNeeded = $serviceDuration/$timeSlotDuration;

        if ($timeSlotsNeeded === 1)
        {
            return response()->json($times);
        }

        $availableTimeSlots[0] = [$times[0]];

        $k = 0;

        for($i = 1; $i <  count($times) -1; $i++)//
        {
            if($times[$i]->start_time === $times[$i-1]->finish_time)
            {
                $availableTimeSlots[$k][] = $times[$i];

            }else{
                $availableTimeSlots[$k] = [];
                $availableTimeSlots[$k][] = $times[$i];
            }

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

        $serviceDuration = 0;

        foreach ($servicesId as $serviceId)
        {
            $serviceDuration += Service::query()->find($serviceId)->duration;
        }

        $times = Time::query()
            ->newTimeSlots()
            ->active()
            ->get();

        $timeSlotDuration = Setting::query()->first()->time_slot_duration;

        $timeSlotsNeeded = $serviceDuration/$timeSlotDuration;

        $fastestTimeSlots = [$times[0]];

        for($i = 1; $i <  count($times); $i++)
        {
            if(count($fastestTimeSlots) === $timeSlotsNeeded)
            {
                break;
            }

            if($times[$i]->start_time === $times[$i-1]->finish_time)
            {
                $fastestTimeSlots[] = $times[$i];

            }else{
                $fastestTimeSlots = [];
                $fastestTimeSlots[] = $times[$i];
            }
        }

        return response()->json($fastestTimeSlots);
    }
}
