<?php

namespace App\Http\Controllers\API\V1;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\GenericNameResource;
use App\Models\GenericName;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GenericNameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ResponseHelper::findSuccess(
            'User Types',
            GenericNameResource::collection(GenericName::all())
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
            $request->only('name'),
            [
                'name' => "required|unique:App\Models\GenericName,name,null,id,deleted_at,NULL"
            ]
        );
        if ($validator->fails()) {
            return ResponseHelper::validationFail(
                'Generic name',
                $validator->errors()
            );
        }
        $genericName = GenericName::create($request->only('name'));
        return ResponseHelper::createSuccess(
            'Generic name',
            new GenericNameResource($genericName)
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\GenericName  $genericName
     * @return \Illuminate\Http\Response
     */
    public function show(GenericName $genericName)
    {

        return ResponseHelper::findSuccess(
            'Generic name',
            new GenericNameResource($genericName)
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\GenericName  $genericName
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GenericName $genericName)
    {
        $validator = Validator::make(
            $request->only('name'),
            [
                'name' => "required|unique:App\Models\GenericName,name," . $genericName->id . ",id,deleted_at,NULL"
            ]
        );
        if ($validator->fails()) {
            return ResponseHelper::validationFail(
                'Generic name',
                $validator->errors()
            );
        }
        $genericName->update($request->only('name'));
        return ResponseHelper::updateSuccess(
            'Generic name',
            new GenericNameResource($genericName)
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GenericName  $genericName
     * @return \Illuminate\Http\Response
     */
    public function destroy(GenericName $genericName)
    {
        $genericName->delete();
        return ResponseHelper::deleteSuccess('Generic Name');
    }
}