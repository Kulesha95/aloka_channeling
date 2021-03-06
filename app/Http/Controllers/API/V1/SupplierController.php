<?php

namespace App\Http\Controllers\API\V1;

use App\Constants\GoodReceives;
use App\Constants\PurchaseOrders;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\BatchResource;
use App\Http\Resources\PurchaseOrderResource;
use App\Http\Resources\SupplierResource;
use App\Models\Batch;
use App\Models\GoodReceive;
use App\Models\Supplier;
use App\Rules\PhoneNumber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ResponseHelper::findSuccess(
            'Suppliers',
            SupplierResource::collection(Supplier::all())
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
            $request->only(['email', 'address', 'register_number', 'telephone', 'name']),
            [
                'name' => "required",
                'email' => "required|email",
                'address' => "required",
                'telephone' => ["required", new PhoneNumber()],
                'register_number' => 'required'
            ]
        );
        if ($validator->fails()) {
            return ResponseHelper::validationFail(
                'Supplier',
                $validator->errors()
            );
        }
        $supplier = Supplier::create($request->only(['email', 'address', 'register_number', 'telephone', 'name']));
        return ResponseHelper::createSuccess(
            'Supplier',
            new SupplierResource($supplier)
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show(Supplier $supplier)
    {
        return ResponseHelper::findSuccess(
            'Supplier',
            new SupplierResource($supplier)
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Supplier $supplier)
    {
        $validator = Validator::make(
            $request->only(['email', 'address', 'register_number', 'telephone', 'name']),
            [
                'name' => "required",
                'email' => "required|email",
                'address' => "required",
                'telephone' => ["required", new PhoneNumber()],
                'register_number' => 'required'
            ]
        );
        if ($validator->fails()) {
            return ResponseHelper::validationFail(
                'Supplier',
                $validator->errors()
            );
        }
        if ($validator->fails()) {
            return ResponseHelper::validationFail(
                'Supplier',
                $validator->errors()
            );
        }
        $supplier->update($request->only(['email', 'address', 'register_number', 'telephone', 'name']));
        return ResponseHelper::updateSuccess(
            'Supplier',
            new SupplierResource($supplier)
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Supplier $supplier)
    {
        $supplier->delete();
        return ResponseHelper::deleteSuccess('Supplier');
    }

    /**
     * Get supplier purchase orders.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function purchaseOrders(Supplier $supplier)
    {
        return ResponseHelper::findSuccess(
            'Purchase Orders',
            PurchaseOrderResource::collection(
                $supplier->purchaseOrders->whereIn('status', [
                    PurchaseOrders::PENDING,
                    PurchaseOrders::PARTIAL_COMPLETED
                ])
            )
        );
    }

    /**
     * Get supplier returnable batches.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function returnable(Supplier $supplier)
    {
        $supplierGrns = $supplier->goodReceives->concat(
            GoodReceive::where('supplierable_type', GoodReceives::PURCHASE_ORDER)
                ->whereIn('supplierable_id', $supplier->purchaseOrders->pluck('id'))->get()
        );
        $batches = Batch::whereIn('good_receive_id', $supplierGrns->pluck('id'))
            ->get();
        return ResponseHelper::findSuccess('Batches', BatchResource::collection($batches));
    }
}