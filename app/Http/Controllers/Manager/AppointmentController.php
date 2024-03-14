<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Service;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index()
    {
        $totalCount = Appointment::query()
            ->filterService()
            ->filterTime()
            ->count();

        $appointments = Appointment::query()
            ->filterService()
            ->filterTime()
            ->paginate(Controller::DEFAULT_PAGINATE);

        $services = Service::all();

        return view('managers.appointments.index', compact('appointments', 'services', 'totalCount'));
    }
}
