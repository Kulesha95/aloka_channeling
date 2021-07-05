<?php

namespace App\Http\Controllers\API\V1;

use App\Constants\Appointments;
use App\Constants\Expenses;
use App\Constants\Incomes;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\BatchResource;
use App\Http\Resources\ItemSuppliersResource;
use App\Models\Appointment;
use App\Models\Batch;
use App\Models\Doctor;
use App\Models\Expense;
use App\Models\Income;
use App\Models\Item;
use App\Models\Patient;
use Carbon\Carbon;
use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Get General Data Summary
     */
    public function generalDataSummary()
    {
        $doctorsCount = Doctor::count();
        $patientsCount = Patient::count();
        $monthlyIncome = "Rs." . number_format(Income::where('date', 'like', Carbon::now()->format('Y-m-') . "%")->sum('amount'), 2);
        $monthlyAppointments = Appointment::where('date', 'like', Carbon::now()->format('Y-m-') . "%")->count();
        return ResponseHelper::findSuccess('General Data Summary', [
            "doctors_count" => $doctorsCount,
            "patients_count" => $patientsCount,
            "monthly_income" => $monthlyIncome,
            "monthly_appointments" => $monthlyAppointments
        ]);
    }

    /**
     * Get General Data Summary
     */
    public function appointmentsDataSummary()
    {
        $totalAppointments = Appointment::where('date', 'like', Carbon::now()->format('Y-m-') . "%")->get();
        return ResponseHelper::findSuccess('General Data Summary', [
            "total_appointments" => $totalAppointments->count(),
            "confirmations_pending" => $totalAppointments->where('status', Appointments::NEW)->count(),
            "payments_pending" => $totalAppointments->where('status', Appointments::CONFIRMED)->count(),
            "rejected_appointments" => $totalAppointments->where('status', Appointments::REJECTED)->count()
        ]);
    }

    /**
     * Get Income Data Summary
     */
    public function incomeGraphData()
    {
        $incomes = Income::all();
        $channelingIncomes = $incomes->where('incomeable_type', Incomes::CHANNELING_PAYMENT)
            ->sortBy('date')->groupBy('date')->map(function ($row) {
                return [
                    'x' => $row->first()['date'],
                    'y' => $row->sum('amount')
                ];
            })->values()->all();
        $pharmacyIncomes = $incomes->where('incomeable_type', Incomes::PHARMACY_PAYMENT)
            ->sortBy('date')->groupBy('date')->map(function ($row) {
                return [
                    'x' => $row->first()['date'],
                    'y' => $row->sum('amount')
                ];
            })->values()->all();

        return ResponseHelper::findSuccess('Income Graph Data', [
            'channelingIncomeGraphData' => $channelingIncomes,
            'pharmacyIncomeGraphData' => $pharmacyIncomes,
        ]);
    }

    /**
     * Get Items Data Summary
     */
    public function itemsSummaryData()
    {
        $items = Item::all();
        $batches = Batch::all();
        $deficitItems = $items->filter(function ($item) {
            return $item->stock <= $item->reorder_level;
        });
        $deficitItemsCount = $deficitItems->count();
        $expiredItems = $batches->filter(function ($batch) {
            return $batch->expire_date <= now()->toDateString();
        });
        $expiredItemsCount = $expiredItems->count();
        return ResponseHelper::findSuccess('Items Summary Data', [
            'deficitItems' => ItemSuppliersResource::collection($deficitItems),
            'deficitItemsCount' => $deficitItemsCount,
            'expiredItems' => BatchResource::collection($expiredItems),
            'expiredItemsCount' => $expiredItemsCount
        ]);
    }

    /**
     * Get Stock Summary
     */
    public function stockSummaryData()
    {
        $items = Item::all();
        return ResponseHelper::findSuccess('Items Summary Data',  ItemSuppliersResource::collection($items));
    }

    /**
     * Get Doctor Channeling Summary
     */
    public function doctorChannelingsSummary()
    {
        $schedules = Auth::user()->doctor->schedules;
        $appointmentsCount = Appointment::whereIn('schedule_id', $schedules->pluck('id'))
            ->where('date', now()->toDateString())
            ->whereIn('status', [Appointments::PENDING, Appointments::COMPLETED])
            ->get()->count();
        $paymentsPending = "Rs." . number_format($schedules->sum('balance'), 2);
        return ResponseHelper::findSuccess('Items Summary Data', [
            'total_shedules_count' => $schedules->count(),
            'today_appointments_count' => $appointmentsCount,
            'payments_pending' => $paymentsPending,
        ]);
    }

    /**
     * Get Doctor Daily Income
     */
    public function doctorIncomeGraphData()
    {
        $schedules = Auth::user()->doctor->schedules;
        $channelingIncomeGraphData = Appointment::whereIn('schedule_id', $schedules->pluck('id'))
            ->whereIn('status', [Appointments::PENDING, Appointments::COMPLETED])
            ->get()
            ->sortBy('date')->groupBy('date')->map(function ($row) {
                return [
                    'x' => $row->first()['date'],
                    'y' => $row->sum(function ($appointment) {
                        return $appointment->schedule->doctor_fee;
                    })
                ];
            })->values()->all();
        $receivedPaymentsGraphData = Expense::whereIn('expensable_id', $schedules->pluck('id'))
            ->get()
            ->sortBy('date')->groupBy('date')->map(function ($row) {
                return [
                    'x' => $row->first()['date'],
                    'y' => $row->sum('amount')
                ];
            })->values()->all();
        return ResponseHelper::findSuccess('Items Summary Data', [
            'channelingIncomeGraphData' => $channelingIncomeGraphData,
            'receivedPaymentsGraphData' => $receivedPaymentsGraphData,
        ]);
    }

    /**
     * Get General Data Summary
     */
    public function expenseGraphData()
    {
        $expenses = Expense::all();
        $supplierPayments =  $expenses->where('expensable_type', Expenses::GOOD_RECEIVE)
            ->sortBy('date')->groupBy('date')->map(function ($row) {
                return [
                    'x' => $row->first()['date'],
                    'y' => $row->sum('amount')
                ];
            })->values()->all();
        $doctorPayments =  $expenses->where('expensable_type', Expenses::SCHEDULE_PAYMENT)
            ->sortBy('date')->groupBy('date')->map(function ($row) {
                return [
                    'x' => $row->first()['date'],
                    'y' => $row->sum('amount')
                ];
            })->values()->all();

        return ResponseHelper::findSuccess('Expense Graph Data', [
            'supplierPaymentsGraphData' => $supplierPayments,
            'doctorPaymentsGraphData' => $doctorPayments,
        ]);
    }
}