<?php

use App\Constants\Appointments;
use App\Constants\UserTypes;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('documents/{type}/{id}/{action}', 'DocumentController@getDocument')->name('documents.getPdf');

Route::middleware('auth')->group(function () {
    Route::view('appointments/', 'appointments.index', [
        "receptionist" => UserTypes::RECEPTIONIST,
        "confirmed" => Appointments::CONFIRMED,
        "rejected" => Appointments::REJECTED
    ]);
    Route::view('calendar/', 'pages.calendar');
    Route::view('channelings/', 'pages.channeling', [
        "confirmed" => Appointments::CONFIRMED,
        "rejected" => Appointments::REJECTED,
        "completed" => Appointments::COMPLETED,
        "onHold" => Appointments::PENDING
    ]);
    Route::view('channelTypes/', 'channelTypes.index');
    route::view('dashboard', 'dashboard.index')->name('dashboard');
    route::view('doctors', 'doctors.index', ['userType' => UserTypes::DOCTOR]);
    route::view('items', 'items.index');
    route::view('itemTypes', 'itemTypes.index');
    Route::view('patients/', 'patients.index', ['userType' => UserTypes::PATIENT]);
    route::view('schedules', 'schedules.index');
    Route::view('users/', 'users.index');
    Route::view('userTypes/', 'userTypes.index')->name('userTypes.index.view');
    Route::get('logout', '\Laravel\Fortify\Http\Controllers\AuthenticatedSessionController@destroy');
});