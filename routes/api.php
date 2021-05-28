<?php

use App\Http\Controllers\API\V1\PaymentIncomeController;
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
	Route::put('appointment/{appointment}/updateStatus', 'AppointmentController@updateStatus')->name('appointments.updateStatus');
	Route::get('appointmentDetails/{appointment}', 'AppointmentController@appointmentDetails');
	Route::get('appointments/{schedule}/{currentNumber}/next', 'AppointmentController@next')->name('appointments.next');
	Route::get('appointments/{schedule}/{currentNumber}/back', 'AppointmentController@back')->name('appointments.back');
	Route::get('appointments/{schedule}/{number}/search', 'AppointmentController@search')->name('appointments.search');
	Route::get('doctors/schedule', 'DoctorController@schedule')->name('doctors.schedule');
	Route::get('patients/{patient}/history', 'PatientController@history')->name('patients.history');
	Route::get('scheduleSummary/{schedule}/{date}', 'ScheduleController@scheduleSummary');


	Route::apiResource('appointments', AppointmentController::class);
	Route::apiResource('appointment.incomes', AppointmentIncomeController::class)->except(['destroy', 'update']);
	Route::apiResource('channelTypes', ChannelTypeController::class);
	Route::apiResource('doctors', DoctorController::class);
	Route::apiResource('patients', PatientController::class);
	Route::apiResource('schedules', ScheduleController::class);
	Route::apiResource('users', UserController::class);
	Route::apiResource('userTypes', UserTypeController::class);
});