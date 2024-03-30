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
        $page = request('page') ?? 1;

        $users = cache()->remember(
            'users.' . str($page),
            Controller::DEFAULT_CACHE_SECONDS,
            fn() => User::query()
                ->where('is_manager', false)
                ->paginate(Controller::DEFAULT_PAGINATE)
        );

        return view('managers.users.index', compact('users'));
    }
}
