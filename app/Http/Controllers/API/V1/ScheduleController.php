<?php

namespace App\Http\Controllers\API\V1;

use App\Constants\Appointments;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\ScheduleResource;
use App\Models\Appointment;
use App\Models\Schedule;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ResponseHelper::findSuccess(
            'Schedules',
            ScheduleResource::collection(Schedule::whereDate('date_to', '>=', now())->get())
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
            $request->only(['doctor_id', 'date_from', 'date_to', 'time_from', 'time_to', 'channeling_fee', 'repeat']),
            [
                'date_from' => "required",
                'date_to' => "required|after_or_equal:date_from",
                'time_from' => "required",
                'time_to' => "required|after:time_from",
                'doctor_id' => "required",
                'channeling_fee' => "required",
                'repeat' => "required",
            ]
        );
        if ($validator->fails()) {
            return ResponseHelper::validationFail(
                'Schedule',
                $validator->errors()
            );
        }
        $schedule = Schedule::create($request->only(['doctor_id', 'date_from', 'date_to', 'time_from', 'time_to', 'channeling_fee', 'repeat']));
        $schedule->refresh();
        return ResponseHelper::createSuccess(
            'Schedule',
            new ScheduleResource($schedule)
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function show(Schedule $schedule)
    {
        return ResponseHelper::findSuccess(
            'Schedule',
            new ScheduleResource($schedule)
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Schedule $schedule)
    {
        $validator = Validator::make(
            $request->only(['doctor_id', 'date_from', 'date_to', 'time_from', 'time_to', 'channeling_fee', 'repeat']),
            [
                'date_from' => "required",
                'date_to' => "required|after_or_equal:date_from",
                'time_from' => "required",
                'time_to' => "required|after:time_from",
                'doctor_id' => "required",
                'channeling_fee' => "required",
                'repeat' => "required",
            ]
        );
        if ($validator->fails()) {
            return ResponseHelper::validationFail(
                'Schedule',
                $validator->errors()
            );
        }
        $schedule->update($request->only(['doctor_id', 'date_from', 'date_to', 'time_from', 'time_to', 'channeling_fee', 'repeat']));
        return ResponseHelper::updateSuccess(
            'Schedule',
            new ScheduleResource($schedule)
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function destroy(Schedule $schedule)
    {
        $schedule->delete();
        return ResponseHelper::deleteSuccess('Schedule');
    }

    /**
     * Find all the events in the specified date range .
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $schedules = Schedule::whereDate('date_to', '>=', $request->get('start'))->whereDate('date_from', '<=', $request->get('end'))->get();

        $events = [];
        foreach ($schedules as $schedule) {
            $event = [];
            if ($schedule->repeat == 7) {
                $event = [
                    "rrule" => [
                        "freq" => 'weekly',
                        "dtstart" => $schedule->date_from,
                        "until" => $schedule->date_to
                    ],
                    // "exdate" => ['2021-05-03']
                ];
            } else {
                $event = [
                    'start' => $schedule->date_to . "T" . $schedule->time_from,
                    'allDay' => true
                ];
            }
            $event["title"] =  $schedule->doctor->name . " - " . $schedule->doctor->channelType->channel_type;
            $event["backgroundColor"] =  $schedule->doctor->channelType->colour;
            $event["borderColor"] =  $schedule->doctor->channelType->colour;
            $event["extendedProps"] =  [
                "time" => Carbon::createFromFormat("H:i:s", $schedule->time_from)->format('h:iA') .
                    " - " . Carbon::createFromFormat("H:i:s", $schedule->time_to)->format('h:iA'),
                "channelType" => $schedule->doctor->channelType->channel_type,
                "id" => $schedule->id
            ];
            array_push($events, $event);
        }
        return response()->json($events);
    }


    /**
     * Find all the events in the specified date range .
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function scheduleSummary(Request $request, Schedule $schedule, $date)
    {
        if ($date != "null") {
            if ($schedule->repeat) {
                $selectedDate = Carbon::createFromDate($date);
                $appointmentStartDate = Carbon::createFromDate($schedule->date_from);
                if ($selectedDate->dayOfWeek == $appointmentStartDate->dayOfWeek) {
                    $searchDate = $date;
                } else {
                    $searchDate = $selectedDate->next($appointmentStartDate->dayName)->format("Y-m-d");
                }
            } else {
                $searchDate = $schedule->date_to;
            }
        } else {
            if ($schedule->repeat) {
                $appointmentStartDate = Carbon::createFromDate($schedule->date_from);
                $searchDate = Carbon::now()->next($appointmentStartDate->dayName)->format("Y-m-d");
            } else {
                $searchDate = $schedule->date_to;
            }
        }
        $number = Appointment::whereDate('date', $searchDate)->where('schedule_id', $schedule->id)->count() + 1;
        $time = Carbon::createFromFormat("H:i:s", $schedule->time_from)->addMinutes(($number - 1) * Appointments::AVERAGE_APPOINTMENT_TIME)->format("H:i:s");
        return ResponseHelper::findSuccess("Approximation Details", ["number" => $number, "time" => $time, "date" => $searchDate]);
    }
}