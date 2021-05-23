<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::get('schedules/search', "ScheduleController@search")->name('schedules.search');

Route::middleware('auth:api')->group(function () {
	Route::apiResource('appointments', AppointmentController::class);
	Route::apiResource('channelTypes', ChannelTypeController::class);
	Route::apiResource('doctors', DoctorController::class);
	Route::apiResource('patients', PatientController::class);
	Route::apiResource('schedules', ScheduleController::class);
	Route::apiResource('users', UserController::class);
	Route::apiResource('userTypes', UserTypeController::class);

	Route::get('scheduleSummary/{schedule}/{date}', 'ScheduleController@scheduleSummary');
	Route::get('appointmentDetails/{appointment}', 'AppointmentController@appointmentDetails');
	Route::put('appointment/{appointment}/updateStatus', 'AppointmentController@updateStatus');
});