<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\UploadFileService;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    protected $uploadService;

    public function __construct(UploadFileService $uploadFileService)
    {
        $this->uploadService = $uploadFileService;
    }

    public function store(Request $request)
    {
        $url = $this->uploadService->store($request);
        if ($url != false) {
            return response()->json([
                'error' => false,
                'url' => $url,
            ]);
        }

        return response()->json([
            'error' => true,
        ]);
    }
}