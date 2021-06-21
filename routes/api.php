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

Route::apiResource('channelTypes', ChannelTypeController::class)->only(['index']);
Route::post('doctors/search', "DoctorController@search")->name('doctors.search');
Route::get('doctors/todayDoctorsList', "DoctorController@todayDoctorsList")->name('doctors.todayDoctorsList');
Route::get('schedules/search', "ScheduleController@search")->name('schedules.search');
Route::get('schedules/summary/{schedule}/{date}', 'ScheduleController@scheduleSummary')->name('schedules.summary');

Route::middleware('auth:api')->group(function () {

	Route::get('appointments/{appointment}/details', 'AppointmentController@appointmentDetails')->name('appointments.details');
	Route::get('appointments/{appointment}/prescriptions', 'AppointmentController@prescriptions')->name('appointments.prescriptions');
	Route::put('appointments/{appointment}/updateStatus', 'AppointmentController@updateStatus')->name('appointments.updateStatus');
	Route::get('appointments/pendingPayments', 'AppointmentController@pendingPayments')->name('appointments.pendingPayments');
	Route::get('appointments/{schedule}/{currentNumber}/back', 'AppointmentController@back')->name('appointments.back');
	Route::get('appointments/{schedule}/{currentNumber}/next', 'AppointmentController@next')->name('appointments.next');
	Route::get('appointments/{schedule}/{number}/search', 'AppointmentController@search')->name('appointments.search');

	Route::get('dashboard/appointmentsDataSummary', 'DashboardController@appointmentsDataSummary')->name('dashboard.appointmentsDataSummary');
	Route::get('dashboard/generalDataSummary', 'DashboardController@generalDataSummary')->name('dashboard.generalDataSummary');
	Route::get('dashboard/incomeGraphData', 'DashboardController@incomeGraphData')->name('dashboard.incomeGraphData');
	Route::get('dashboard/itemsSummaryData', 'DashboardController@itemsSummaryData')->name('dashboard.itemsSummaryData');
	Route::get('dashboard/stockSummaryData', 'DashboardController@stockSummaryData')->name('dashboard.stockSummaryData');

	Route::get('explorationTypes/tests', 'ExplorationTypeController@tests')->name('explorationTypes.tests');

	Route::get('batches/available', 'BatchController@available')->name('batches.available');

	Route::get('doctors/schedule', 'DoctorController@schedule')->name('doctors.schedule');

	Route::get('items/getPurchasingItems', 'ItemController@getPurchasingItems')->name('items.getPurchasingItems');

	Route::post('patient/{patient}/explorations/storeReceptionist', 'ExplorationController@storeReceptionist')->name('explorations.storeReceptionist');

	Route::get('patients/{patient}/history', 'PatientController@history')->name('patients.history');

	Route::post('prescriptions/addBatch', 'PrescriptionController@addBatch')->name('prescriptions.addBatch');
	Route::post('prescriptions/addItem', 'PrescriptionController@addItem')->name('prescriptions.addItem');
	Route::post('prescriptions/createNew/{appointment}', 'PrescriptionController@createNew')->name('prescriptions.createNew');
	Route::get('prescriptions/{prescription}/details', 'PrescriptionController@prescriptionDetails')->name('prescriptions.details');
	Route::get('prescriptions/internalPrescriptions', 'PrescriptionController@internalPrescriptions')->name('prescriptions.internalPrescriptions');
	Route::get('prescriptions/paid', 'PrescriptionController@paid')->name('prescriptions.paid');
	Route::get('prescriptions/pendingPayments', 'PrescriptionController@pendingPayments')->name('prescriptions.pendingPayments');
	Route::get('prescriptions/prescriptionBills', 'PrescriptionController@prescriptionBills')->name('prescriptions.prescriptionBills');
	Route::put('prescriptions/{prescription}/updateStatus', 'PrescriptionController@updateStatus')->name('prescriptions.updateStatus');
	Route::get('prescriptions/{prescription}/batches', 'PrescriptionController@batches')->name('prescriptions.batches');
	Route::get('prescriptions/{prescription}/items', 'PrescriptionController@items')->name('prescriptions.items');


	Route::get('supplier/{supplier}/nonSupplyingItems', 'SupplierItemController@nonSupplyingItems')->name('suppliers.nonSupplyingItems');

	Route::apiResource('appointments', AppointmentController::class);
	Route::apiResource('appointment.incomes', AppointmentIncomeController::class)->except(['destroy', 'update']);
	Route::apiResource('channelTypes', ChannelTypeController::class)->except(['index']);
	Route::apiResource('channelType.channelReasons', ChannelReasonController::class)->except(['update', 'show']);
	Route::apiResource('directions', DirectionController::class)->only(['index']);
	Route::apiResource('doctors', DoctorController::class);
	Route::apiResource('dosageUnits', DosageUnitController::class);
	Route::apiResource('goodReceives', GoodReceiveController::class);
	Route::apiResource('explorationTypes', ExplorationTypeController::class);
	Route::apiResource('genericNames', GenericNameController::class);
	Route::apiResource('items', ItemController::class);
	Route::apiResource('itemTypes', ItemTypeController::class);
	Route::apiResource('prescription.incomes', PrescriptionIncomeController::class)->except(['destroy', 'update']);
	Route::apiResource('patients', PatientController::class);
	Route::apiResource('patient.explorations', ExplorationController::class);
	Route::apiResource('prescriptions', PrescriptionController::class);
	Route::apiResource('purchaseOrders', PurchaseOrderController::class);
	Route::apiResource('suppliers', SupplierController::class);
	Route::apiResource('supplier.items', SupplierItemController::class)->except(['update', 'show']);
	Route::apiResource('schedules', ScheduleController::class);
	Route::apiResource('users', UserController::class);
	Route::apiResource('userTypes', UserTypeController::class);
});