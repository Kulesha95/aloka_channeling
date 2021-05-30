<?php

namespace App\Http\Controllers\API\V1;

use App\Constants\ExplorationTypes;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Models\Exploration;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ExplorationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Exploration  $exploration
     * @return \Illuminate\Http\Response
     */
    public function show(Exploration $exploration)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Exploration  $exploration
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Exploration $exploration)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Exploration  $exploration
     * @return \Illuminate\Http\Response
     */
    public function destroy(Exploration $exploration)
    {
        //
    }

    /**
     * Save Basic Explorations
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function storeReceptionist(Request $request, Patient $patient)
    {
        $validator = Validator::make(
            $request->only(['height', 'weight', 'bmi']),
            [
                'height' => 'required',
                'weight' => 'required',
                'bmi' => 'required'
            ]
        );
        if ($validator->fails()) {
            return ResponseHelper::validationFail(
                'Exploration',
                $validator->errors()
            );
        }
        $date = now()->toDateString();
        $time = now()->toTimeString();
        Exploration::create([
            'value' => $request->get('height'),
            'date' => $date,
            'time' => $time,
            'patient_id' => $patient->id,
            'exploration_type_id' => ExplorationTypes::HEIGHT,
        ]);
        Exploration::create([
            'value' => $request->get('weight'),
            'date' => $date,
            'time' => $time,
            'patient_id' => $patient->id,
            'exploration_type_id' => ExplorationTypes::WEIGHT,
        ]);
        Exploration::create([
            'value' => number_format($request->get('weight') / ($request->get('height') * $request->get('height')), 2, '.', ''),
            'date' => $date,
            'time' => $time,
            'patient_id' => $patient->id,
            'exploration_type_id' => ExplorationTypes::WEIGHT,
        ]);
        return ResponseHelper::createSuccess('Explorations', []);
    }
}