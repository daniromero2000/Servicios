<?php

namespace App\Entities\CreditStatuses\Requests;

use App\Entities\Base\BaseFormRequest;

class CreateCreditStatusRequest extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'unique:customer_statuses']
        ];
    }
}
