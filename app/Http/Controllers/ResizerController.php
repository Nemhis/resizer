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
        $mode = $params->get('mode', 'fit');

        $path = Storage::disk('upload')->path($fileName);

        $resized = Image::cache(function($image) use ($path, $width, $height, $mode) {
            $img = $image->make($path);

            if ($mode === 'fit') {
                $img = $img->fit($width, $height);
            } else {
                $img = $img->resize($width, $height);
            }

            return $img;
        }, 43200, true);


        return $resized->response();
    }
}
