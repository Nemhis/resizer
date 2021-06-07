<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResizeRequest;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ResizerController extends Controller
{
    public function resize(string $fileName, ResizeRequest $request)
    {
        $params = collect($request->validated());
        $width = (int) $params->get('width');
        $height = (int) $params->get('height');
//        $mode = $params->get('mode', 'fit');

            return Image::make(Storage::disk('upload')->path($fileName))->fit($width, $height)->response();
    }
}
