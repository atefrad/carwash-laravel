<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\TrackAppointmentController;
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

Route::resource('appointments', AppointmentController::class);

Route::prefix('/track-appointment')
    ->controller(TrackAppointmentController::class)
    ->name('trackAppointment.')
    ->group(function () {
        Route::get('/',  'create')->name('create');
        Route::post('/', 'store')->name('store');
    });



