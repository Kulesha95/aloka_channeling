<?php

namespace App\Http\Controllers\API\V1;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserTypeResource;
use App\Models\UserType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
            $userTypes = UserType::all();
        
        return ResponseHelper::findSuccess(
            'User Types',
            UserTypeResource::collection($userTypes)
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
            $request->only('user_type'),
            [
                'user_type' => "required|unique:App\Models\UserType,user_type,null,id,deleted_at,NULL"
            ]
        );
        if ($validator->fails()) {
            return ResponseHelper::validationFail(
                'User Type',
                $validator->errors()
            );
        }
        $userType = UserType::create($request->only('user_type'));
        return ResponseHelper::createSuccess(
            'User Type',
            new UserTypeResource($userType)
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserType  $userType
     * @return \Illuminate\Http\Response
     */
    public function show(UserType $userType)
    {
        return ResponseHelper::findSuccess(
            'User Type',
            new UserTypeResource($userType)
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserType  $userType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserType $userType)
    {
        $validator = Validator::make(
            $request->only('user_type'),
            [
                'user_type' => "required|unique:App\Models\UserType,user_type," . $userType->id . ",id,deleted_at,NULL"
            ]
        );
        if ($validator->fails()) {
            return ResponseHelper::validationFail(
                'User Type',
                $validator->errors()
            );
        }
        $userType->update($request->only('user_type'));
        return ResponseHelper::updateSuccess(
            'User Type',
            new UserTypeResource($userType)
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserType  $userType
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserType $userType)
    {
        $userType->delete();
        return ResponseHelper::deleteSuccess('User Type');
    }
}
