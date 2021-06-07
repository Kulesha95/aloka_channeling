<?php

namespace App\Http\Controllers\API\V1;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\ChannelReasonResource;
use App\Models\ChannelReason;
use App\Models\ChannelType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ChannelReasonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Models\ChannelType  $channelType
     * @return \Illuminate\Http\Response
     */
    public function index(ChannelType $channelType)
    {
        return ResponseHelper::findSuccess('Channel Reasons', ChannelReasonResource::collection($channelType->channelReasons));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ChannelType  $channelType
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, ChannelType $channelType)
    {
        $validator = Validator::make(
            $request->only(['reason']),
            [
                'reason' => "required"
            ]
        );
        if ($validator->fails()) {
            return ResponseHelper::validationFail(
                'Channel Reason',
                $validator->errors()
            );
        }
        $channelReason = $channelType->channelReasons()->create($request->only(['reason']));
        return ResponseHelper::createSuccess(
            'Channel Reason',
            new ChannelReasonResource($channelReason)
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ChannelType  $channelType
     * @param  \App\Models\ChannelReason  $channelReason
     * @return \Illuminate\Http\Response
     */
    public function destroy(ChannelType $channelType, ChannelReason $channelReason)
    {
        if ($channelReason->channel_type_id != $channelType->id) {
            return ResponseHelper::findFail('Channel Reason');
        }
        $channelReason->delete();
        return ResponseHelper::deleteSuccess('Channel Reason');
    }
}