<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Appointments\AppointmentStoreRequest;
use App\Http\Requests\Appointments\AppointmentUpdateRequest;
use App\Models\Appointment;
use App\Models\Service;
use App\Models\Time;
use Carbon\Carbon;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    public function index()
    {
        $appointments = Appointment::query()
            ->where('user_id', Auth::id())
            ->paginate(Controller::DEFAULT_PAGINATE);

        return view('users.appointments.index', compact('appointments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $services = Service::all();

        return view('users.appointments.create', compact('services'));
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
     * @throws AuthorizationException
     */
    public function show(Appointment $appointment)
    {
        $this->authorize('view', $appointment);

        return view('users.appointments.show', compact('appointment'));
    }

    /**
     * Show the form for editing the specified resource.
     * @throws AuthorizationException
     */
    public function edit(Appointment $appointment)
    {
        $this->authorize('update', $appointment);

        $services = Service::all();

        $selectedTimeValues = '';

        foreach ($appointment->times as $time)
        {
            $selectedTimeValues .= $time->id . ',';
        }

        return view('users.appointments.edit',
            compact('appointment', 'services', 'selectedTimeValues'));
    }

    /**
     * Update the specified resource in storage.
     * @throws AuthorizationException
     */
    public function update(AppointmentUpdateRequest $request, Appointment $appointment)
    {
        $this->authorize('update', $appointment);

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
     * @throws AuthorizationException
     */
    public function destroy(Appointment $appointment)
    {
        $this->authorize('update', $appointment);

        $appointment->delete();

        return redirect()->route('appointments.index');
    }

}
