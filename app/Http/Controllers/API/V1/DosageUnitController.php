<?php

namespace App\Http\Controllers\API\V1;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\DosageUnitResource;
use App\Models\DosageUnit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DosageUnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ResponseHelper::findSuccess(
            'Dosage unit',
            DosageUnitResource::collection(DosageUnit::all())
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
            $request->only(['name', "unit"]),
            [
                'name' => "required|unique:App\Models\DosageUnit,name,null,id,deleted_at,NULL",
                'unit' => "required|unique:App\Models\DosageUnit,unit,null,id,deleted_at,NULL"
            ]
        );
        if ($validator->fails()) {
            return ResponseHelper::validationFail(
                'Dosage unit',
                $validator->errors()
            );
        }
        $dosageUnit = DosageUnit::create($request->only(['name', 'unit']));
        return ResponseHelper::createSuccess(
            'Dosage unit',
            new DosageUnitResource($dosageUnit)
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DosageUnit  $dosageUnit
     * @return \Illuminate\Http\Response
     */
    public function show(DosageUnit $dosageUnit)
    {

        return ResponseHelper::findSuccess(
            'Dosage unit',
            new DosageUnitResource($dosageUnit)
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DosageUnit  $dosageUnit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DosageUnit $dosageUnit)
    {
        $validator = Validator::make(
            $request->only(['name', 'unit']),
            [
                'name' => "required|unique:App\Models\DosageUnit,name," . $dosageUnit->id . ",id,deleted_at,NULL",
                'unit' => "required|unique:App\Models\DosageUnit,unit," . $dosageUnit->id . ",id,deleted_at,NULL",
            ]
        );
        if ($validator->fails()) {
            return ResponseHelper::validationFail(
                'Dosage unit',
                $validator->errors()
            );
        }
        $dosageUnit->update($request->only(['name', 'unit']));
        return ResponseHelper::updateSuccess(
            'Dosage unit',
            new DosageUnitResource($dosageUnit)
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DosageUnit  $dosageUnit
     * @return \Illuminate\Http\Response
     */
    public function destroy(DosageUnit $dosageUnit)
    {
        $dosageUnit->delete();
        return ResponseHelper::deleteSuccess('Dosage unit');
    }
}