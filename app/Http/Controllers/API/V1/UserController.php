<?php

namespace App\Http\Controllers\API\V1;

use App\Helpers\FileStorageHelper;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Notifications\PasswordReset;
use App\Notifications\UserAccountCreated;
use App\Rules\PhoneNumber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ResponseHelper::findSuccess(
            'Users',
            UserResource::collection(User::where("user_type_id", ">", "3")->get())
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
            $request->only(['email', 'password', 'image', 'username', 'user_type_id', 'mobile', 'name']),
            [
                'name' => "required",
                'email' => "required|email",
                'username' => "required|unique:App\Models\User,username,null,id,deleted_at,NULL",
                'mobile' => ["required", new PhoneNumber()],
                'image' => 'mimes:jpeg,jpg,png,gif',
                'user_type_id' => 'required'
            ]
        );
        if ($validator->fails()) {
            return ResponseHelper::validationFail(
                'User',
                $validator->errors()
            );
        }
        $image = ($request->has('image'))
            ? FileStorageHelper::uploadFile(
                $request,
                "image",
                "user"
            )
            : null;
        $password = Str::random(8);
        $apiToken = Str::random(80);
        $user = User::create(
            $request->only(['email', 'username', 'user_type_id', 'mobile', 'name']) +
                ["password" => Hash::make($password), "image" => $image, "api_token" => "$apiToken"]
        );
        $user->notify(new UserAccountCreated($password));
        return ResponseHelper::createSuccess(
            'User',
            new UserResource($user)
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return ResponseHelper::findSuccess(
            'User',
            new UserResource($user)
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $validator = Validator::make(
            $request->only(['email', 'password', 'image', 'username', 'user_type_id', 'mobile', 'name']),
            [
                'name' => "required",
                'email' => "required|email",
                'username' => "required|unique:App\Models\User,username," . $user->id . ",id,deleted_at,NULL",
                'mobile' => ["required", new PhoneNumber()],
                'image' => 'mimes:jpeg,jpg,png,gif',
                'user_type_id' => 'required'
            ]
        );
        if ($validator->fails()) {
            return ResponseHelper::validationFail(
                'User',
                $validator->errors()
            );
        }
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
        return ResponseHelper::updateSuccess(
            'User',
            new UserResource($user)
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return ResponseHelper::deleteSuccess('User');
    }

    /**
     * Reset Password
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function resetPassword(Request $request)
    {
        $user = User::where('username', $request->get('username'))->first();
        if (!$user) {
            return ResponseHelper::findFail("User account");
        }
        $password = Str::random(8);
        $user->update(['password' => Hash::make($password)]);
        $user->notify(new PasswordReset($password));
        return ResponseHelper::success('Your new password has been sent to your email.', []);
    }
}