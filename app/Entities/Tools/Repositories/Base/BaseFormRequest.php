<?php

namespace App\Entities\Tools\Base;

use Illuminate\Foundation\Http\FormRequest;

abstract class BaseFormRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }
}
