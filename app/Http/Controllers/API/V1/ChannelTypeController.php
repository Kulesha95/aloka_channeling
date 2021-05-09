<?php

namespace App\Http\Controllers\API\V1;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\ChannelTypeResource;
use App\Models\ChannelType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ChannelTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ResponseHelper::findSuccess(
            'Channel Types',
            ChannelTypeResource::collection(ChannelType::all())
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
            $request->only(['channel_type', 'description', 'colour']),
            [
                'channel_type' => "required"
            ]
        );
        if ($validator->fails()) {
            return ResponseHelper::validationFail(
                'Channel Type',
                $validator->errors()
            );
        }
        $channelType = ChannelType::create($request->only(['channel_type', 'description', 'colour']));
        return ResponseHelper::createSuccess(
            'Channel Type',
            new ChannelTypeResource($channelType)
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ChannelType  $channelType
     * @return \Illuminate\Http\Response
     */
    public function show(ChannelType $channelType)
    {
        return ResponseHelper::findSuccess(
            'Channel Type',
            new ChannelTypeResource($channelType)
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ChannelType  $channelType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ChannelType $channelType)
    {
        $validator = Validator::make(
            $request->only(['channel_type', 'description', 'colour']),
            [
                'channel_type' => "required"
            ]
        );
        if ($validator->fails()) {
            return ResponseHelper::validationFail(
                'Channel Type',
                $validator->errors()
            );
        }
        $channelType->update($request->only(['channel_type', 'description', 'colour']));
        return ResponseHelper::updateSuccess(
            'Channel Type',
            new ChannelTypeResource($channelType)
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ChannelType  $channelType
     * @return \Illuminate\Http\Response
     */
    public function destroy(ChannelType $channelType)
    {
        $channelType->delete();
        return ResponseHelper::deleteSuccess('Channel Type');
    }
}