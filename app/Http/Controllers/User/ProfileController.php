<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function show(User $user)
    {
        return view('users.profile.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('users.profile.edit', compact('user'));
    }

    public function update(ProfileUpdateRequest $request,User $user)
    {
        $user->update($request->validated());

        return redirect()->route('users.edit', $user)
            ->with(['status' => 'profile-updated']);
    }

    public function destroy(User $user)
    {
        Auth::logout();

        $user->delete();

        return redirect()->route('home');

    }
}
