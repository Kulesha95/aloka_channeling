<?php

namespace App\Http\Controllers\API\V1;

use App\Constants\Appointments;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\AppointmentResource;
use App\Http\Resources\ChannelTypeResource;
use App\Http\Resources\DoctorResource;
use App\Http\Resources\PatientResource;
use App\Http\Resources\PrescriptionResource;
use App\Http\Resources\ScheduleResource;
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
        return ResponseHelper::updateSuccess(
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

    /**
     * Get all appointment details
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function appointmentDetails(Appointment $appointment)
    {
        $data = [
            'appointment' => new AppointmentResource($appointment),
            'schedule' => new ScheduleResource($appointment->schedule),
            'patient' => new PatientResource($appointment->patient),
            'doctor' => new DoctorResource($appointment->schedule->doctor),
            'channelType' => new ChannelTypeResource($appointment->schedule->doctor->channelType)
        ];
        return ResponseHelper::findSuccess('Appointment', $data);
    }

    /**
     * Get all appointment details
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function updateStatus(Request $request, Appointment $appointment)
    {
        $appointment->update(["status" => $request->get('status')]);
        return ResponseHelper::updateSuccess('Appointment', $appointment);
    }

    /**
     * Get next appointment
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function next(Schedule $schedule, $currentNumber)
    {
        $appointment = $schedule->appointments
            ->where('date', now()->toDateString())
            ->where('status', Appointments::PAID)
            ->sortBy('number')
            ->where('number', '>', $currentNumber)
            ->first();
        return $appointment
            ? ResponseHelper::findSuccess('Next Appointment', new AppointmentResource($appointment))
            : ResponseHelper::error('No More Next Appointments', []);
    }

    /**
     * Get previous appointment
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function back(Schedule $schedule, $currentNumber)
    {
        $appointment = $schedule->appointments
            ->where('date', now()->toDateString())
            ->where('status', Appointments::PAID)
            ->sortByDesc('number')
            ->where('number', '<', $currentNumber)
            ->first();
        return $appointment
            ? ResponseHelper::findSuccess('Previous Appointment', new AppointmentResource($appointment))
            : ResponseHelper::error('No More Previous Appointments', []);
    }

    /**
     * Search appointment by number
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function search(Schedule $schedule, $number)
    {
        $appointment = $schedule->appointments
            ->where('number', (int)$number)
            ->where('date', now()->toDateString())
            ->first();
        return $appointment
            ? ResponseHelper::findSuccess('Appointment', new AppointmentResource($appointment))
            : ResponseHelper::findFail('Appointment');
    }

    /**
     * Get Prescriptions List Of The Appointment
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function prescriptions(Appointment $appointment)
    {
        $prescriptions = $appointment->prescriptions;
        return ResponseHelper::findSuccess('Prescriptions', PrescriptionResource::collection($prescriptions));
    }

    /**
     * Get Payment Pending Appointments List
     *
     * @return \Illuminate\Http\Response
     */
    public function pendingPayments()
    {
        $appointments = Appointment::all()->filter(function ($appointment) {
            return $appointment->balance != 0 && ($appointment->status == Appointments::CONFIRMED || $appointment->status == Appointments::NEW);
        });
        return ResponseHelper::findSuccess('Appointments', AppointmentResource::collection($appointments));
    }
}