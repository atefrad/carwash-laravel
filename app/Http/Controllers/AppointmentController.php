<?php

namespace App\Http\Controllers;

use App\Http\Requests\Appointments\AppointmentStoreRequest;
use App\Models\Appointment;
use Illuminate\Http\Request;
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
        $appointments = Appointment::query()->where('start_time', '>', now())->orderBy('start_time')->get();

       dd(strtotime($appointments[0]->start_time) - strtotime(now()));

//        foreach($appointments as $appointment)
//        {
//            //
//        }
//
//        return view('appointments.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AppointmentStoreRequest $request)
    {
        dd($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
        $serviceId = $_GET['service_id'];

        $appointments = Appointment::query()->where('start_time', '>', now())->orderBy('start_time')->get();

        return response()->json(['success' => true]);
    }
}
