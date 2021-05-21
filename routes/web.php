<?php

use App\Constants\UserTypes;
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

Route::middleware('auth')->group(function () {
    Route::view('appointments/', 'appointments.index');
    Route::view('channelTypes/', 'channelTypes.index');
    route::view('dashboard', 'dashboard.index')->name('dashboard');
    route::view('doctors', 'doctors.index', ['userType' => UserTypes::DOCTOR]);
    Route::view('patients/', 'patients.index', ['userType' => UserTypes::PATIENT]);
    route::view('schedules', 'schedules.index');
    Route::view('users/', 'users.index');
    Route::view('userTypes/', 'userTypes.index')->name('userTypes.index.view');
    Route::get('logout', '\Laravel\Fortify\Http\Controllers\AuthenticatedSessionController@destroy');
});