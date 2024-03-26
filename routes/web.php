<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Manager\AppointmentController as ManagerAppointmentController;
use App\Http\Controllers\Manager\ProfileController as ManagerProfileController;
use App\Http\Controllers\Manager\UserController;
use App\Http\Controllers\TrackAppointmentController;
use App\Http\Controllers\User\AppointmentController as UserAppointmentController;
use App\Http\Controllers\User\ProfileController as UserProfileController;
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

//home
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {

    //user appointments
    Route::resource('/users/appointments', UserAppointmentController::class);

    //user profile
    Route::prefix('/users')
        ->controller(UserProfileController::class)
        ->name('users.')
        ->group(function () {

            Route::get('/{user}', 'show')->name('show');
            Route::get('/{user}/edit', 'edit')->name('edit');
            Route::put('/{user}', 'update')->name('update');
            Route::delete('/{user}', 'destroy')->name('destroy');
        });

    //tracking appointments
    Route::resource('/track-appointment', TrackAppointmentController::class)
        ->only(['create', 'store']);
});

//manager routes
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

        //manager profile
        Route::controller(ManagerProfileController::class)->group(function () {

            Route::get('/edit','edit')->name('edit');
            Route::patch('/','update')->name('update');
            Route::delete('/','destroy')->name('destroy');
        });
    });

require __DIR__.'/auth.php';


