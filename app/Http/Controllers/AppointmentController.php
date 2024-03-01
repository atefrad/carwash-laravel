<?php

namespace App\Http\Controllers;

use App\Http\Requests\Appointments\AppointmentStoreRequest;
use App\Models\Appointment;
use App\Models\Service;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $services = Service::all();
        return view('appointments.create', compact('services'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AppointmentStoreRequest $request)
    {
        $appointment = Appointment::query()->create($request->validated());

        return redirect()->route('appointments.show', $appointment);
    }

    /**
     * Display the specified resource.
     */
    public function show(Appointment $appointment)
    {
        return view('appointments.show', compact('appointment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function fastestTime()
    {
        function isBetweenNineAndTwentyOne($dateTime): bool
        {
            $hour = substr($dateTime, 11, 2);

            return ($hour >= 9 && $hour < 21);
        }

        $appointmentsStationOne = Appointment::query()
            ->where('start_time', '>', now())
            ->where('station',1)
            ->orderBy('start_time')
            ->get();

        $appointmentsStationTwo = Appointment::query()
            ->where('start_time', '>', now())
            ->where('station',2)
            ->orderBy('start_time')
            ->get();

        function fastestAppointmentTime($appointments, $stationId)
        {
            $serviceId = $_GET['service_id'];

            $serviceDuration = Service::query()->where('id', $serviceId)->first()->duration;

            $count = count($appointments);

//            $startOfTheDay = Carbon::createFromTimeString('09:00');
//            $endOfTheDay = Carbon::createFromTimeString('21:00');

            //check to see if shop is open now
//            $isShopOpenNow = now()->between($startOfTheDay, $endOfTheDay);
            $isShopOpenNow = isBetweenNineAndTwentyOne(now());

            //check to see if there is enough time to accept a new appointment. I reserved 30 minutes time before giving the appointment so the user can have enough time to get there.
            $isEnoughTimeLeft = (strtotime(Carbon::createFromTimeString('21:00')) - strtotime(now()))/60 > 30 + $serviceDuration;

            if($isShopOpenNow && $isEnoughTimeLeft)
            {
                if((strtotime($appointments[0]->start_time) - strtotime(now()))/60 > (30 + $serviceDuration))
                {
                     return now()->addMinutes(30);
                }
            }

            //------------------------------------------------------
            //TO DO!!
            //check to see if there is time before first appointment
            if(now()->format('H') >= 21 && now()->format('H') < 24)
            {
                $nextDayFirstTime = str_replace(now()->addDay()->format('H:i:s'),'09:00:00',now()->addDay());

            }else if (now()->format('H') >= 0 && now()->format('H') < 9) {

                $nextDayFirstTime = str_replace(now()->format('H:i:s'),'09:00:00',now());
            }
            $nextDayFirstAppointment = Appointment::query()->where('start_time','>=', $nextDayFirstTime)->where('station', $stationId)->orderBy('start_time')->first();

            if(strtotime($nextDayFirstAppointment->start_time) - strtotime($nextDayFirstTime)/60 > $serviceDuration)
        {
            return $nextDayFirstTime;
        }
            //------------------------------------------------------

            for($i = 1; $i < $count; $i++)
            {
                if(
                    (strtotime($appointments[$i]->start_time) - strtotime($appointments[$i - 1]->finish_time))/60
                    > $serviceDuration
                    && isBetweenNineAndTwentyOne(Carbon::createFromTimestamp(
                        strtotime($appointments[$i - 1]->finish_time) +($serviceDuration * 60)))
                )
                {
                    return $appointments[$i - 1]->finish_time;

                }
            }

            if(isBetweenNineAndTwentyOne(Carbon::createFromTimestamp(
                strtotime($appointments[$count - 1]->finish_time) + ($serviceDuration * 60))))
            {
                return  $appointments[$count - 1]->finish_time;
            }
            else {
                return Carbon::createFromTimestamp(
                    strtotime($appointments[$count - 1]->finish_time))->addHours(12);
            }
        }

        $fastestTimeStationOne = fastestAppointmentTime($appointmentsStationOne, 1);

        $fastestTimeStationTwo = fastestAppointmentTime($appointmentsStationTwo, 2);

        if($fastestTimeStationOne < $fastestTimeStationTwo)
        {
            return response()->json(["fastest_time" => date("Y-m-d H:i",strtotime($fastestTimeStationOne)), "station" => 1]);
        }else{
            return response()->json(["fastest_time" => date("Y-m-d H:i",strtotime($fastestTimeStationTwo)), "station" => 2]);
        }

    }
}
