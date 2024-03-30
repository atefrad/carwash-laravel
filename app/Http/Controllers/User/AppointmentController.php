<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\Appointment\AppointmentStoreRequest;
use App\Http\Requests\User\Appointment\AppointmentUpdateRequest;
use App\Models\Appointment;
use App\Models\Service;
use App\Models\Time;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AppointmentController extends Controller
{
    public function index()
    {
        $page = request('page') ?? 1;
        $user_id = Auth::id();

        $appointments = cache()->remember(
            'appointments.' . str($page) . '_user.' . str($user_id),
            Controller::DEFAULT_CACHE_SECONDS,
            fn() => Appointment::query()
            ->where('user_id', $user_id)
            ->paginate(Controller::DEFAULT_PAGINATE)
        );

        return view('users.appointments.index', compact('appointments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $services = cache()->remember(
            'services',
            Controller::DEFAULT_CACHE_SECONDS,
            fn() => Service::all()
        );

        return view('users.appointments.create', compact('services'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AppointmentStoreRequest $request)
    {
        try{
            DB::beginTransaction();

            $appointment = Appointment::query()
                ->create($request->validated());

            /**
             * @var Appointment $appointment
             */
            $appointment->services()->attach($request->safe()->only('services')['services']);

            $appointmentTimeslots = $request->safe()->only('time')['time'];

            $appointment->times()->attach( $appointmentTimeslots);

            $this->increaseCount( $appointmentTimeslots);

            DB::commit();

        }catch(\Throwable $exception)
        {
            DB::rollBack();

            return back()->withErrors(['transaction' => 'Your Transaction failed!']);
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

        $services = cache()->remember(
            'services',
            Controller::DEFAULT_CACHE_SECONDS,
            fn() => Service::all()
        );

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

        try{

            DB::beginTransaction();

            if($appointment->services()->pluck('services.id') != $request->safe()->only('services')) {

                $appointment->services()->detach();

                $appointment->services()->attach($request->safe()->only('services')['services']);
            }

            if($appointment->times()->pluck('times.id') != $request->safe()->only('time')) {
                $previousTimeIds = $appointment->times()->pluck('times.id');

                $this->decreaseCount($previousTimeIds);

                $appointment->times()->detach();

                $appointmentTimeslots = $request->safe()->only('time')['time'];

                $appointment->times()->attach($appointmentTimeslots);

                $this->increaseCount( $appointmentTimeslots);
            }

            $appointment->update($request->validated());

            DB::commit();

        }catch(\Throwable $exception)
        {
            DB::rollBack();

            return back()->withErrors(['transaction' => 'Your Transaction failed!']);
        }

        return redirect()->route('appointments.show', $appointment);
    }

    /**
     * Remove the specified resource from storage.
     * @throws AuthorizationException
     */
    public function destroy(Appointment $appointment)
    {
        $this->authorize('update', $appointment);

        try{

            DB::beginTransaction();

            $appointment->services()->detach();

            $timesId = $appointment->times()->pluck('times.id');

            $this->decreaseCount($timesId);

            $appointment->times()->detach();

            $appointment->delete();

            DB::commit();

        }catch(\Throwable $exception)
        {
            DB::rollBack();

            return back()->with(['fail' => 'Error! The appointment was not deleted!']);
        }

        return redirect()->route('appointments.index')
            ->with(['success' => 'The appointment deleted successfully']);
    }

    private function increaseCount(array $times)
    {
        foreach ($times as $time)
        {
            $timeSlot = Time::query()->find($time);
            $timeSlot->count = ($timeSlot->count + 1);
            $timeSlot->save();
        }
    }

    private function decreaseCount($times)
    {
        foreach($times as $time)
        {
            $timeSlot = Time::query()->find($time);
            $timeSlot->count = ($timeSlot->count - 1);
            $timeSlot->save();
        }
    }

}
