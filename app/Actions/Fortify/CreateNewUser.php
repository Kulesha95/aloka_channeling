<?php

namespace App\Actions\Fortify;

use App\Models\Patient;
use App\Models\User;
use App\Notifications\PatientAccountCreated;
use App\Notifications\UserAccountCreated;
use App\Rules\IdNumber;
use App\Rules\PhoneNumber;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Illuminate\Support\Str;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        $validator = Validator::make(
            Arr::only($input, [
                'email',
                'password',
                'password_confirmation',
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
                'email' => "required|email",
                'username' => "required|unique:App\Models\User,username,null,id,deleted_at,NULL",
                'mobile' =>  ['required', new PhoneNumber()],
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
                        $input['id_type'] ?? null,
                        $input['birth_date'] ?? null,
                        $input['gender'] ?? null
                    )
                ],
                'password' => $this->passwordRules(),
            ]
        )->validate();;
        try {
            DB::beginTransaction();
            $image = null;
            $password = Hash::make($input['password']);
            $apiToken = Str::random(80);
            $user = User::create(
                Arr::only($input, ['email', 'user_type_id', 'mobile', 'name', 'username']) +
                    [
                        "password" => $password,
                        "image" => $image,
                        "api_token" => $apiToken,
                    ]
            );
            $user->notify(new PatientAccountCreated());
            $patient = Patient::create(
                Arr::only($input, (["name", "birth_date", "gender", "address", "id_type", "id_number"])) +
                    ["user_id" => $user->id]
            );
            DB::commit();
            return $user;
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect('/');
        }
    }
}