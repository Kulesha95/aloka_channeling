<?php

namespace App\Http\Controllers\API\V1;

use App\Constants\Appointments;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\ExceptionResource;
use App\Models\Exception;
use App\Models\Schedule;
use App\Notifications\AppointmentCanceled;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;

class ExceptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function index(Schedule $schedule)
    {
        return ResponseHelper::findSuccess('Exceptions', ExceptionResource::collection($schedule->exceptions));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Schedule $schedule)
    {
        $validator = Validator::make(
            $request->only('date'),
            [
                'date' => "required|after_or_equal:" . $schedule->date_from . "|before_or_equal:" . $schedule->date_to
            ]
        );
        if ($validator->fails()) {
            return ResponseHelper::validationFail(
                'Exception',
                $validator->errors()
            );
        }
        $exception = $schedule->exceptions()->create(['date' => $request->get('date')]);
        $appointments = $schedule->appointments->where('date', $exception->date)->whereNotIn('status',[
            Appointments::COMPLETED,
            Appointments::REJECTED,
            Appointments::PENDING
        ]);
        Notification::send($appointments->pluck('patient.user'), new AppointmentCanceled($schedule, $exception));
        return ResponseHelper::createSuccess('Schedule Exception', new ExceptionResource($exception));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Schedule  $schedule
     * @param  \App\Models\Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function show(Schedule $schedule, Exception $exception)
    {
        return ResponseHelper::findSuccess('Schedule Exception', new ExceptionResource($exception));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Schedule  $schedule
     * @param  \App\Models\Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function destroy(Schedule $schedule, Exception $exception)
    {
        $exception->delete();
        return ResponseHelper::deleteSuccess('Schedule Exception');
    }
}