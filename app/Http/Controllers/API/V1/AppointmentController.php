<?php

namespace App\Http\Controllers\API\V1;

use App\Constants\Appointments;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\AppointmentResource;
use App\Models\Appointment;
use App\Models\Schedule;
use App\Notifications\AppointmentCreated;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $appointmentsQuery = Appointment::whereDate('date', '>=', now());
        if (Auth::user()->patient) {
            $appointmentsQuery = $appointmentsQuery->where('patient_id', Auth::user()->patient->id);
        }
        return ResponseHelper::findSuccess(
            'Appointments',
            AppointmentResource::collection($appointmentsQuery->get())
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->only(['schedule_id', 'patient_id', 'date', 'reason']),
            [
                'schedule_id' => "required",
                'patient_id' => "required",
                'date' => "required",
                'reason' => "required",
            ]
        );
        if ($validator->fails()) {
            return ResponseHelper::validationFail(
                'Appointment',
                $validator->errors()
            );
        }
        $schedule = Schedule::find($request->get('schedule_id'));
        $time = $schedule->time_from;
        $appointment = Appointment::create(
            $request->only(['schedule_id', 'patient_id', 'date', 'reason', 'comment']) +
                ["time" => $time, 'status' => Appointments::NEW]
        );
        $appointment->refresh();
        $number = Appointment::where('schedule_id', $schedule->id)->where('id', '<=', $appointment->id)->whereDate('date', $appointment->date)->withTrashed()->count();
        $time = Carbon::createFromFormat("H:i:s", $schedule->time_from)->addMinutes(($number - 1) * Appointments::AVERAGE_APPOINTMENT_TIME)->format("H:i:s");
        $appointment->update(["time" => $time, 'number' => $number]);
        $appointment->patient->user->notify(new AppointmentCreated($appointment));
        return ResponseHelper::createSuccess(
            'Appointment',
            new AppointmentResource($appointment)
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function show(Appointment $appointment)
    {
        return ResponseHelper::findSuccess(
            'Appointment',
            new AppointmentResource($appointment)
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Appointment $appointment)
    {
        $validator = Validator::make(
            $request->only(['reason']),
            [
                'reason' => "required",
            ]
        );
        if ($validator->fails()) {
            return ResponseHelper::validationFail(
                'Appointment',
                $validator->errors()
            );
        }
        $appointment->update($request->only(['reason', 'comment']));
        return ResponseHelper::createSuccess(
            'Appointment',
            new AppointmentResource($appointment)
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Appointment $appointment)
    {
        $appointment->delete();
        return ResponseHelper::deleteSuccess('Appointment');
    }
}