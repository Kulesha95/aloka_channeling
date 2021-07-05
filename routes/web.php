<?php

use App\Constants\Appointments;
use App\Constants\Prescriptions;
use App\Constants\UserTypes;
use App\Models\PurchaseOrder;
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

Route::get('/test', function () {
    $purchaseOrder = PurchaseOrder::with(['batches', 'items'])->find(4);
    $itemQuanities = $purchaseOrder->items->map(function ($item) {
        return [$item->id => $item->pivot->quantity];
    })->values();
    $batchQuanities = $purchaseOrder->batches->map(function ($batch) {
        return [$batch->item_id => $batch->purchase_quantity];
    })->values();
    dd($batchQuanities);
});

Route::view('/', 'frontend.index')->name('frontend.index');
Route::view('about', 'frontend.about')->name('frontend.about');
Route::view('channelingSchedule', 'frontend.channelings')->name('frontend.channelings');
Route::view('contact', 'frontend.contact')->name('frontend.contact');

Route::get('documents/{type}/{id}/{action}', 'DocumentController@getDocument')->name('documents.getPdf');

Route::middleware('auth')->group(function () {
    Route::view('appointments', 'appointments.index', [
        "receptionist" => UserTypes::RECEPTIONIST,
        "confirmed" => Appointments::CONFIRMED,
        "completed" => Appointments::COMPLETED,
        "onHold" => Appointments::PENDING,
        "rejected" => Appointments::REJECTED
    ]);
    Route::view('calendar', 'pages.calendar');
    Route::view('channelings', 'channelings.channeling', [
        "confirmed" => Appointments::CONFIRMED,
        "rejected" => Appointments::REJECTED,
        "pending" => Prescriptions::PENDING_PRESCRIPTION,
        "completed" => Appointments::COMPLETED,
        "onHold" => Appointments::PENDING,
        "medicalPrescription" => Prescriptions::INTERNAL_MEDICAL_PRESCRIPTION,
        "testPrescription" =>  Prescriptions::TEST_PRESCRIPTION
    ]);
    Route::view('channelTypes', 'channelTypes.index');
    route::view('dashboard', 'dashboard.index')->name('dashboard');
    route::view('doctors', 'doctors.index', ['userType' => UserTypes::DOCTOR]);
    route::view('doctorPayments', 'expenses.doctorPaymentsIndex');
    route::view('dosageUnits', 'dosageUnits.index');
    route::view('explorationTypes', 'explorationTypes.index');
    route::view('genericNames', 'genericNames.index');
    route::view('goodReceives', 'goodReceives.index');
    route::view('items', 'items.index');
    route::view('itemTypes', 'itemTypes.index');
    Route::view('patients', 'patients.index', ['userType' => UserTypes::PATIENT]);
    Route::view('payments', 'payments.index', [
        "receptionist" => UserTypes::RECEPTIONIST,
        "rejected" => Appointments::REJECTED,
    ]);
    Route::view('prescriptions', 'prescriptions.index', [
        "medicalPrescription" => Prescriptions::INTERNAL_MEDICAL_PRESCRIPTION,
        "testPrescription" =>  Prescriptions::TEST_PRESCRIPTION,
        "confirmed" => Prescriptions::CONFIRMED_PRESCRIPTION,
        "rejected" => Prescriptions::CANCELED_PRESCRIPTION,
        "pending" => Prescriptions::PENDING_PRESCRIPTION,
        "issued" => Prescriptions::ISSUED_PRESCRIPTION
    ]);
    route::view('purchaseOrders', 'purchaseOrders.index');
    route::view('purchaseReturns', 'purchaseReturns.index');
    route::view('salesReturns', 'salesReturns.index');
    route::view('schedules', 'schedules.index');
    route::view('supplierPayments', 'expenses.supplierPaymentsIndex');
    route::view('suppliers', 'suppliers.index');
    Route::view('users', 'users.index');
    Route::view('userTypes', 'userTypes.index')->name('userTypes.index.view');
    Route::get('logout', '\Laravel\Fortify\Http\Controllers\AuthenticatedSessionController@destroy');
});