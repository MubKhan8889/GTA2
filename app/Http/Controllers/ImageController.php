<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    /**
     * Display specified image
     * 
     * @param string $imageName
     * @return \Illuminate\Http\Response
     */
    public function show($imageName)
    {
        $path = storage_path('app/public/images/{$imageName}');
        if (!Storage::exists('/public/image/{$imageName}')) {abort(404);}
        return response()->file($path);
    }
}
