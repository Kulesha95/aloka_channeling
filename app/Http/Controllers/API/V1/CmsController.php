<?php

namespace App\Http\Controllers\API\V1;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\CmsResource;
use App\Models\Cms;
use Illuminate\Http\Request;

class CmsController extends Controller
{

    /**
     * Display a listing of resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ResponseHelper::findSuccess(
            'Cms data',
            CmsResource::collection(Cms::all())
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
        foreach ($request->all() as $key => $value) {
            Cms::updateOrCreate(['key' => $key], ['value' => $value]);
        }
        return ResponseHelper::updateSuccess('Cms Data', []);
    }
}