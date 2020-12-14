<?php

namespace Modules\Customers\Entities\Customers\Requests;

use App\Entities\Base\BaseFormRequest;

class RegisterCustomerRequest extends BaseFormRequest
{
    public function rules()
    {
        return [
            'name'                 => 'required|string|max:255',
            'password'             => 'required|string|min:8|confirmed',
            'email'             => 'required|string|unique:customers'
            // 'data_politics'        => ['required'],
        ];
    }
}
