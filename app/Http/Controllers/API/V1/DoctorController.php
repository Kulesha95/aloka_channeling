<?php

namespace App\Http\Controllers\API\V1;

use App\Helpers\FileStorageHelper;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\DoctorResource;
use App\Http\Resources\ScheduleResource;
use App\Models\Doctor;
use App\Models\Schedule;
use App\Models\User;
use App\Notifications\UserAccountCreated;
use App\Rules\PhoneNumber;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ResponseHelper::findSuccess(
            'Doctors',
            DoctorResource::collection(Doctor::all())
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
            $request->only(['email', 'password', 'image', 'username', 'user_type_id', 'mobile', "name", "qualification", "works_at", "commission_amount", "commission_type", "channel_type_id"]),
            [
                'email' => "required|email",
                'username' => "required|unique:App\Models\User,username,null,id,deleted_at,NULL",
                'mobile' => ["required", new PhoneNumber()],
                'image' => 'mimes:jpeg,jpg,png,gif',
                'user_type_id' => 'required',
                'name' => 'required',
                'qualification' => 'required',
                'works_at' => 'required',
                'commission_amount' => 'required',
                'commission_type' => 'required',
                'channel_type_id' => 'required',
            ]
        );
        if ($validator->fails()) {
            return ResponseHelper::validationFail(
                'User',
                $validator->errors()
            );
        }
        try {
            DB::beginTransaction();
            $image = ($request->has('image'))
                ? FileStorageHelper::uploadFile(
                    $request,
                    "image",
                    "doctor"
                )
                : null;
            $password = Str::random(8);
            $apiToken = Str::random(80);
            $user = User::create(
                $request->only(['email',  'username', 'user_type_id', 'mobile', 'name']) +
                    ["password" => Hash::make($password), "image" => $image, "api_token" => "$apiToken"]
            );
            $user->notify(new UserAccountCreated($password));
            $doctor = Doctor::create(
                $request->only(["name", "qualification", "works_at", "commission_amount", "commission_type", "channel_type_id"]) +
                    ["user_id" => $user->id]
            );
            DB::commit();
            return ResponseHelper::createSuccess(
                'Doctor',
                new DoctorResource($doctor)
            );
        } catch (\Throwable $th) {
            DB::rollBack();
            return ResponseHelper::error(
                'Something went wrong. Please try again.',
                $th->getMessage()
            );
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function show(Doctor $doctor)
    {
        return ResponseHelper::findSuccess(
            'Doctor',
            new DoctorResource($doctor)
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Doctor $doctor)
    {
        $validator = Validator::make(
            $request->only(['email', 'password', 'image', 'username', 'user_type_id', 'mobile', "name", "qualification", "works_at", "commission_amount", "commission_type", "channel_type_id"]),
            [
                'email' => "required|email",
                'username' => "required|unique:App\Models\User,username," . $doctor->user->id . ",id,deleted_at,NULL",
                'mobile' => ["required", new PhoneNumber()],
                'image' => 'mimes:jpeg,jpg,png,gif',
                'user_type_id' => 'required',
                'name' => 'required',
                'qualification' => 'required',
                'works_at' => 'required',
                'commission_amount' => 'required',
                'commission_type' => 'required',
                'channel_type_id' => 'required',
            ]
        );
        if ($validator->fails()) {
            return ResponseHelper::validationFail(
                'User',
                $validator->errors()
            );
        }
        try {
            DB::beginTransaction();
            $user = $doctor->user;
            $image = ($request->has('image'))
                ? FileStorageHelper::uploadFile(
                    $request,
                    "image",
                    "user"
                )
                : $user->image;
            $user->update(
                $request->only(['email', 'password', 'username', 'user_type_id', 'mobile', 'name']) +
                    ["image" => $image]
            );
            $doctor->update(
                $request->only(["name", "qualification", "works_at", "commission_amount", "commission_type", "channel_type_id"])
            );
            DB::commit();
            return ResponseHelper::updateSuccess(
                'Doctor',
                new DoctorResource($doctor)
            );
        } catch (\Throwable $th) {
            DB::rollBack();
            return ResponseHelper::error(
                'Something went wrong. Please try again.',
                $th->getMessage()
            );
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Doctor $doctor)
    {
        $doctor->delete();
        return ResponseHelper::deleteSuccess('Doctor');
    }

    /**
     * Get Doctor Current Schedule
     *
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function schedule(Request $request)
    {
        $schedule = Auth::user()->doctor->schedules
            ->where('date_from', '<=', now()->toDateString())
            ->where('date_to', '>=', now()->toDateString())
            ->where('time_from', '<=', now()->addHour()->toTimeString())
            ->where('time_to', '>=',  now()->subHour()->toTimeString())
            ->filter(function ($schedule) {
                if ($schedule->repeat == 7) {
                    return Carbon::createFromDate($schedule->date_from)->dayOfWeek == Carbon::now()->dayOfWeek;
                }
                return true;
            })->first();
        return $schedule
            ? ResponseHelper::findSuccess('Doctor Schedule', new ScheduleResource($schedule))
            : ResponseHelper::findFail('Schedule', []);
    }

    /**
     * Get Today visiting Doctors List
     *
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function todayDoctorsList(Request $request)
    {
        $schedules = Schedule::where('date_from', '<=', now()->toDateString())
            ->where('date_to', '>=', now()->toDateString())->get()
            ->filter(function ($schedule) {
                if ($schedule->repeat == 7) {
                    return Carbon::createFromDate($schedule->date_from)->dayOfWeek == Carbon::now()->dayOfWeek;
                }
                return $schedule->date_to == now()->toDateString();
            });
        $doctors = $schedules->map(function ($schedule) {
            return ["schedule" => new ScheduleResource($schedule), "doctor" => new DoctorResource($schedule->doctor)];
        })->values();
        return ResponseHelper::findSuccess('Doctors', $doctors);
    }

    /**
     * Search Doctors
     *
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $schedules = Schedule::where('date_from', '<=', $request->get('to_date'))
            ->where('date_to', '>=', $request->get('from_date'))->with('doctor');
        if ($request->get('name')) {
            $schedules = $schedules->whereHas('doctor', function ($query) use ($request) {
                return $query->where('name', 'like', '%' . $request->get('name') . "%");
            });
        }
        if ($request->get('type')) {
            $schedules = $schedules->whereHas('doctor', function ($query) use ($request) {
                return $query->where('channel_type_id', $request->get('type'));
            });
        }
        $doctors = $schedules->get()->map(function ($schedule) {
            return ["schedule" => new ScheduleResource($schedule), "doctor" => new DoctorResource($schedule->doctor)];
        })->values();
        return ResponseHelper::findSuccess('Doctors', $doctors);
    }
}