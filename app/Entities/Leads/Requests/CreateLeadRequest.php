<?php

namespace App\Entities\Leads\Requests;

use App\Entities\Tools\Base\BaseFormRequest;

class CreateLeadRequest extends BaseFormRequest
{
    public function rules()
    {
        return [
            'identificationNumber' => 'unique:leads',
            'telephone' => 'unique:leads'
        ];
    }
}