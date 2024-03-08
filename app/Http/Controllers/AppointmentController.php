<?php

namespace App\Http\Controllers;

use App\Http\Requests\Appointments\AppointmentStoreRequest;
use App\Http\Requests\Appointments\AppointmentUpdateRequest;
use App\Models\Appointment;
use App\Models\Service;
use App\Models\Setting;
use App\Models\Time;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

        $appointment = Appointment::query()
            ->create($request->validated());

        /**
         * @var Appointment $appointment
         */
        $appointment->services()->attach($request->safe()->only('services')['services']);

        $appointment->times()->attach($request->safe()->only('time')['time']);

        foreach ($request->safe()->only('time')['time'] as $time)
       {
            $timeSlot = Time::query()->find($time);
            $timeSlot->count = ($timeSlot->count + 1);
            $timeSlot->save();

        }

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
    public function edit(Appointment $appointment)
    {
        $services = Service::all();

        $selectedTimeValues = '';

        foreach ($appointment->times as $time)
        {
            $selectedTimeValues .= $time->id . ',';
        }

        return view('appointments.edit',
            compact('appointment', 'services', 'selectedTimeValues'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AppointmentUpdateRequest $request, Appointment $appointment)
    {
        $this-> CheckAuthorize($appointment);

        if($appointment->services()->pluck('services.id') != $request->safe()->only('services')) {

            $appointment->services()->detach();

            $appointment->services()->attach($request->safe()->only('services')['services']);
        }

        if($appointment->times()->pluck('times.id') != $request->safe()->only('time')) {
            $previousTimeIds = $appointment->times()->pluck('times.id');

            foreach ($previousTimeIds as $timeId) {
                $timeSlot = Time::query()->find($timeId);
                $timeSlot->count = ($timeSlot->count - 1);
                $timeSlot->save();
            }

            $appointment->times()->detach();

            $appointment->times()->attach($request->safe()->only('time')['time']);

            foreach ($request->safe()->only('time')['time'] as $time)
            {
                $timeSlot = Time::query()->find($time);
                $timeSlot->count = ($timeSlot->count + 1);
                $timeSlot->save();
            }
        }

        $appointment->update($request->validated());

        return redirect()->route('appointments.show', $appointment);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Appointment $appointment)
    {
        $this-> CheckAuthorize($appointment);

        $appointment->delete();

        return redirect()->route('home');
    }

    private function CheckAuthorize($appointment)
    {
        if(!$appointment->times[0]->day > Carbon::now()->day)
        {
            abort(403);
        }
    }

}
