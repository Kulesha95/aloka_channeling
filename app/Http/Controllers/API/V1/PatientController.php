<?php

namespace App\Http\Controllers\API\V1;

use App\Helpers\FileStorageHelper;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\AppointmentResource;
use App\Http\Resources\PatientResource;
use App\Models\Patient;
use App\Models\User;
use App\Notifications\PatientAccountCreated;
use App\Notifications\UserAccountCreated;
use App\Rules\IdNumber;
use App\Rules\PhoneNumber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ResponseHelper::findSuccess(
            'Patients',
            PatientResource::collection(Patient::all())
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
            $request->only([
                'email',
                'password',
                'image',
                'username',
                'user_type_id',
                'mobile',
                "name",
                "birth_date",
                "gender",
                "address",
                "id_type",
                "id_number"
            ]),
            [
                'email' => "nullable|email",
                'username' => "nullable|unique:App\Models\User,username,null,id,deleted_at,NULL",
                'mobile' =>  ['nullable', new PhoneNumber()],
                'image' => 'mimes:jpeg,jpg,png,gif',
                'user_type_id' => 'required',
                'name' => 'required',
                'birth_date' => 'required',
                'gender' => 'required',
                'address' => 'required',
                'id_type' => 'required',
                'id_number' => [
                    'required',
                    "unique:App\Models\Patient,id_number,null,id,deleted_at,NULL",
                    new IdNumber(
                        $request->get('id_type'),
                        $request->get('birth_date'),
                        $request->get('gender')
                    )
                ],
            ]
        );
        if ($validator->fails()) {
            return ResponseHelper::validationFail(
                'Patient',
                $validator->errors()
            );
        }
        try {
            DB::beginTransaction();
            $image = ($request->has('image'))
                ? FileStorageHelper::uploadFile(
                    $request,
                    "image",
                    "patient"
                )
                : null;
            $password = Str::random(8);
            $apiToken = Str::random(80);
            $user = User::create(
                $request->only(['email', 'user_type_id', 'mobile', 'name']) +
                    [
                        "password" => Hash::make($password),
                        "image" => $image,
                        "api_token" => $apiToken,
                        "username" => $request->get('username') ?? $request->get('id_number')
                    ]
            );
            $user->notify(new PatientAccountCreated($password));
            $patient = Patient::create(
                $request->only(["name", "birth_date", "gender", "address", "id_type", "id_number"]) +
                    ["user_id" => $user->id]
            );
            DB::commit();
            return ResponseHelper::createSuccess(
                'Patient',
                new PatientResource($patient)
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
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function show(Patient $patient)
    {
        return ResponseHelper::findSuccess(
            'Patient',
            new PatientResource($patient)
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Patient $patient)
    {
        $validator = Validator::make(
            $request->only([
                'email',
                'password',
                'image',
                'username',
                'user_type_id',
                'mobile',
                "name",
                "birth_date",
                "gender",
                "address",
                "id_type",
                "id_number"
            ]),
            [
                'email' => "nullable|email",
                'username' => "nullable|unique:App\Models\User,username," . $patient->user->id . ",id,deleted_at,NULL",
                'mobile' =>  ['nullable', new PhoneNumber()],
                'image' => 'mimes:jpeg,jpg,png,gif',
                'user_type_id' => 'required',
                'name' => 'required',
                'birth_date' => 'required',
                'gender' => 'required',
                'address' => 'required',
                'id_type' => 'required',
                'id_number' => [
                    'required',
                    "unique:App\Models\Patient,id_number," . $patient->id . ",id,deleted_at,NULL",
                    new IdNumber(
                        $request->get('id_type'),
                        $request->get('birth_date'),
                        $request->get('gender')
                    )
                ],
            ]
        );
        if ($validator->fails()) {
            return ResponseHelper::validationFail(
                'Patient',
                $validator->errors()
            );
        }
        try {
            DB::beginTransaction();
            $user = $patient->user;
            $image = ($request->has('image'))
                ? FileStorageHelper::uploadFile(
                    $request,
                    "image",
                    "patient"
                )
                : $user->image;
            $user->update(
                $request->only(['email', 'user_type_id', 'mobile', 'name']) +
                    [
                        "image" => $image,
                        "username" => $request->get('username') ?? $request->get('id_number')
                    ]
            );
            $patient->update(
                $request->only(["name", "birth_date", "gender", "address", "id_type", "id_number"])
            );
            DB::commit();
            return ResponseHelper::updateSuccess(
                'Patient',
                new PatientResource($patient)
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
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function destroy(Patient $patient)
    {
        $patient->delete();
        return ResponseHelper::deleteSuccess('Patient');
    }

    /**
     * Get Patient History
     *
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function history(Request $request, Patient $patient)
    {
        $appointments = $patient->appointments;
        return ResponseHelper::findSuccess('Patient History', AppointmentResource::collection($appointments));
    }
}