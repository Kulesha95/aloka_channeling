<?php

namespace App\Helpers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FileStorageHelper
{
    /**
     * Upload Files To Local Storage
     * 
     * @param Request $request
     * @param string $fileInputName
     * @param string $folderName
     * @return string filePath
     */
    public static function uploadFile(Request $request, $fileInput, $folder, $disk = 'public')
    {
        return asset('storage/' . $request->file($fileInput)->storeAs(
            $folder,
            Str::random(10) . (now()->timestamp) . '.' . $request->file($fileInput)->getClientOriginalExtension(),
            $disk
        ));
    }

    /**
     * Upload Files To Local Storage
     * 
     * @param string $file
     */
    public static function deleteFile($file)
    {
        Storage::delete($file);
    }
} 