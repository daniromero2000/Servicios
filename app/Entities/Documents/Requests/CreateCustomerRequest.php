<?php

namespace Modules\Customers\Entities\Customers\Requests;

use App\Entities\Base\BaseFormRequest;

class CreateCustomerRequest extends BaseFormRequest
{
    public function rules()
    {
        return [
            'name'             => ['required', 'bail', 'max:255'],
            'last_name'        => ['required', 'bail', 'max:255'],
            'birthday'         => ['bail', 'date'],
            'scholarity_id'    => ['required', 'bail'],
            'customer_channel_id' => ['required', 'bail'],
            'city_id'          => ['required', 'bail'],
            'genre_id'         => ['required', 'bail'],
            'civil_status_id'  => ['required'],
        ];
    }
}
