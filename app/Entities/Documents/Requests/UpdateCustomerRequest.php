<?php

namespace Modules\Customers\Entities\Customers\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCustomerRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name'             => ['required', 'bail', 'max:255'],
            'last_name'        => ['required', 'bail', 'max:255'],
            'scholarity_id'    => ['required', 'bail'],
            'customer_channel_id' => ['required', 'bail'],
            'city_id'          => ['required', 'bail'],
        ];
    }
}
