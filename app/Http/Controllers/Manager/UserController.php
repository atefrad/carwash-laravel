<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::query()
            ->where('is_manager', false)
            ->paginate(Controller::DEFAULT_PAGINATE);

        return view('managers.users.index', compact('users'));
    }
}
