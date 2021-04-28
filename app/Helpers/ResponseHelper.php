<?php

namespace App\Helpers;

use Symfony\Component\HttpFoundation\Response;

class ResponseHelper
{
    /**
     * Response Message After Successfully Executing The Action
     * 
     * @param string $message
     * @param array $data
     * @return JsonResponse response
     */
    public static function success($message, $data)
    {
        return response()->json([
            "message" => $message,
            "data" => $data,
        ], Response::HTTP_OK);
    }

    /**
     * Response Message After Fails The Execution Of The Action
     * 
     * @param string $message
     * @param array $data
     * @return JsonResponse response
     */
    public static function error($message, $data)
    {
        return response()->json([
            "message" => $message,
            "data" => $data,
        ], Response::HTTP_BAD_REQUEST);
    }

    /**
     * Response Message After Successfully Creating A New Item In The Database
     * 
     * @param string $item
     * @param array $data
     * @return JsonResponse response
     */
    public static function createSuccess($item, $data)
    {
        return response()->json([
            "message" => $item . " has been created successfully",
            "data" => $data,
        ], Response::HTTP_CREATED);
    }

    /**
     * Response Message When Validation Error Occured
     * 
     * @param string $item
     * @param array $data
     * @return JsonResponse response
     */
    public static function validationFail($item, $data)
    {
        return response()->json([
            "message" => $item . " data validation has been failed",
            "data" => $data,
        ], Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /**
     * Response Message When Successfully Updated The Item In The Database
     * 
     * @param string $item
     * @param array $data
     * @return JsonResponse response
     */
    public static function updateSuccess($item, $data)
    {
        return response()->json([
            "message" => $item . " has been updated successfully",
            "data" => $data,
        ], Response::HTTP_OK);
    }

    /**
     * Response Message When Successfully Deleted The Item In The Database
     * 
     * @param string $item
     * @return JsonResponse response
     */
    public static function deleteSuccess($item)
    {
        return response()->json([
            "message" => $item . " has been deleted successfully",
            "data" => [],
        ], Response::HTTP_OK);
    }

    /**
     * Response Message When Successfully Find The Item In The Database
     * 
     * @param string $item
     * @param array $data
     * @return JsonResponse response
     */
    public static function findSuccess($item, $data)
    {
        return response()->json([
            "message" => $item . " has been found successfully",
            "data" => $data,
        ], Response::HTTP_OK);
    }

    /**
     * Response Message When Failed To Find The Item In The Database Or Requested Page
     * 
     * @param string $item
     * @return JsonResponse response
     */
    public static function findFail($item)
    {
        return response()->json([
            "message" => $item . " can not be found",
            "data" => [],
        ], Response::HTTP_NOT_FOUND);
    }

    /**
     * Response Message When Server Error
     * 
     * @return JsonResponse response
     */
    public static function networkFail()
    {
        return response()->json([
            "message" => "Something went wrong. Please contact the system developers",
            "data" => [],
        ], Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    /**
     * Response Message When Unauthorized Request
     * 
     * @return JsonResponse response
     */
    public static function unauthorized()
    {
        return response()->json([
            "message" => "Log in required",
            "data" => [],
        ], Response::HTTP_UNAUTHORIZED);
    }
}