<?php

namespace App\Http\Controllers;

use App\Http\Requests\Appointments\TrackAppointmentStoreRequest;
use App\Models\Appointment;

class TrackAppointmentController extends Controller
{
    public function create()
    {
        return view('appointments.track-appointment');
    }

    public  function store(TrackAppointmentStoreRequest $request)
    {
        $appointment = Appointment::query()
            ->where('phone', request('phone'))
            ->where('tracking_code', request('tracking_code'))
            ->first();

        if($appointment)
        {
            return redirect()->route('appointments.show', $appointment);

        }else{
            return redirect()->back()->with(['error' => 'Phone or tracking_code is not correct!']);
        }

    }
}
