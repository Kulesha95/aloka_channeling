<?php

namespace App\Http\Controllers\API\V1;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\ExplorationTypeResource;
use App\Models\ExplorationType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ExplorationTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ResponseHelper::findSuccess(
            'Exploration Types',
            ExplorationTypeResource::collection(ExplorationType::all())
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
            $request->only(['exploration_type', 'unit']),
            [
                'exploration_type' => "required|unique:App\Models\ExplorationType,exploration_type,null,id,deleted_at,NULL",
                'unit' => 'required'
            ]
        );
        if ($validator->fails()) {
            return ResponseHelper::validationFail(
                'Exploration Type',
                $validator->errors()
            );
        }
        $explorationType = ExplorationType::create($request->only(['exploration_type', 'unit', 'is_test']));
        return ResponseHelper::createSuccess(
            'Exploration Type',
            new ExplorationTypeResource($explorationType)
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ExplorationType  $explorationType
     * @return \Illuminate\Http\Response
     */
    public function show(ExplorationType $explorationType)
    {
        return ResponseHelper::findSuccess(
            'Exploration Type',
            new ExplorationTypeResource($explorationType)
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ExplorationType  $explorationType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ExplorationType $explorationType)
    {
        $validator = Validator::make(
            $request->only(['exploration_type', 'unit']),
            [
                'exploration_type' => "required|unique:App\Models\ExplorationType,exploration_type," . $explorationType->id . ",id,deleted_at,NULL",
                'unit' => 'required'
            ]
        );
        if ($validator->fails()) {
            return ResponseHelper::validationFail(
                'Exploration Type',
                $validator->errors()
            );
        }
        $explorationType->update($request->only(['exploration_type', 'unit']) +
            ["is_test" => $request->has('is_test')]);
        return ResponseHelper::updateSuccess(
            'Exploration Type',
            new ExplorationTypeResource($explorationType)
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ExplorationType  $explorationType
     * @return \Illuminate\Http\Response
     */
    public function destroy(ExplorationType $explorationType)
    {
        $explorationType->delete();
        return ResponseHelper::deleteSuccess('Exploration Type');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function tests()
    {
        return ResponseHelper::findSuccess(
            'Exploration Types',
            ExplorationTypeResource::collection(ExplorationType::where('is_test', '1')->get())
        );
    }
}