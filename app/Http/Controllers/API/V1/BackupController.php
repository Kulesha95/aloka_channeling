<?php

namespace App\Http\Controllers\API\V1;

use App\Helpers\FileStorageHelper;
use App\Helpers\ResponseHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Artisan;

class BackupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $files = Storage::disk('local')->files('backup');
        $files = new Collection($files);
        $files = $files->map(function ($file) {
            return [
                'name' => str_replace('backup/', '', $file),
                'path' =>  $file,
            ];
        })->values();
        return ResponseHelper::findSuccess(
            'Backups',
            $files
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
        Artisan::call('backup:run');
        return ResponseHelper::createSuccess('Backup', []);
    }

    /**
     * Delete selected resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        FileStorageHelper::deleteFile($request->get('path'));
        return ResponseHelper::deleteSuccess('Backup');
    }
}