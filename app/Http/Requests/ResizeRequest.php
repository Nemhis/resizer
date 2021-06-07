<?php

namespace App\Http\Requests;

use App\Rules\ResizeModeRule;

class ResizeRequest extends FormRequest
{
    public function rules()
    {
        return [
            'width' => 'required|integer',
            'height' => 'required|integer',
            'mode' => new ResizeModeRule(),
        ];
    }
}
