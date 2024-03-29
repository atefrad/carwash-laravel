<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Http\Requests\Manager\Service\ServiceStoreRequest;
use App\Http\Requests\Manager\Service\ServiceUpdateRequest;
use App\Models\Service;
use App\Models\Setting;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = Service::all();

        return view('managers.services.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $timeSlotDuration = Setting::query()->first()->time_slot_duration;

        return view('managers.services.create', compact('timeSlotDuration'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ServiceStoreRequest $request)
    {
        Service::query()->create($request->validated());

        return redirect()->route('managers.services.index')
            ->with(['success' => 'Service created successfully!']);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Service $service)
    {
        $timeSlotDuration = Setting::query()->first()->time_slot_duration;

        return view('managers.services.edit', compact('service', 'timeSlotDuration'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ServiceUpdateRequest $request, Service $service)
    {
        $service->update($request->validated());

        return redirect()->route('managers.services.index')
            ->with(['success' => 'Service updated successfully!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        $service->delete();

        return redirect()->route('managers.services.index')
            ->with(['success' => 'Service deleted successfully!']);
    }
}
