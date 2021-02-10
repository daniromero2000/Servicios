<?php

namespace App\Entities\Brands\Requests;

use App\Entities\Base\BaseFormRequest;

class CreateBrandRequest extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'unique:brands']
        ];
    }
}
