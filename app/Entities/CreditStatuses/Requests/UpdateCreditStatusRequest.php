<?php

namespace App\Entities\CreditStatuses\Requests;

use App\Entities\Base\BaseFormRequest;
use Illuminate\Validation\Rule;

class UpdateCreditStatusRequest extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required']
        ];
    }
}
