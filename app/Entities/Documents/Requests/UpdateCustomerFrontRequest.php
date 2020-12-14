<?php

namespace Modules\Customers\Entities\Customers\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCustomerFrontRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'name'          => ['required'],
            'last_name'     => ['required'],
            'data_politics' => ['required']
        ];
    }
}
