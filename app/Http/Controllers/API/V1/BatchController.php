<?php

namespace App\Http\Controllers\API\V1;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\BatchResource;
use App\Models\Batch;
use Illuminate\Http\Request;

class BatchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ResponseHelper::findSuccess('Batches', BatchResource::collection(Batch::all()));
    }

    /**
     * Get stock available batches
     *
     * @return \Illuminate\Http\Response
     */
    public function available()
    {
        $batches = Batch::where('stock_quantity', '>', '0')->get();
        return ResponseHelper::findSuccess('Batches', BatchResource::collection($batches));
    }
}