<?php

use App\Http\Controllers\Manager\AppointmentController as ManagerAppointmentController;
use App\Http\Controllers\Manager\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TrackAppointmentController;
use App\Http\Controllers\User\AppointmentController as UserAppointmentController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('index');
})->name('home');

Route::get('/users/dashboard', function () {
    return view('users.dashboard');
})->middleware('auth')->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //appointments
//    Route::resource('appointments', AppointmentController::class);

    //user appointments
    Route::resource('/users/appointments', UserAppointmentController::class);

    //tracking appointments
    Route::resource('/track-appointment', TrackAppointmentController::class)
        ->only(['create', 'store']);
});

Route::prefix('/managers')
    ->middleware(['auth', 'isManager'])
    ->name('managers.')
    ->group(function () {

        Route::get('/', function () {
            return view('managers.index');
        })->name('index');

        Route::get('/appointments', [ManagerAppointmentController::class, 'index'])
            ->name('appointments.index');

        Route::get('/users', [UserController::class, 'index'])
            ->name('users.index');
    });

require __DIR__.'/auth.php';


