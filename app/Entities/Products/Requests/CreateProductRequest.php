<?php

namespace App\Entities\Products\Requests;

use App\Entities\Base\BaseFormRequest;

class CreateProductRequest extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'sku' => ['required'],
            'name' => ['required', 'unique:products'],
            'price' => ['required'],
            'cover' => ['required', 'file', 'image:png,jpeg,jpg,gif']
        ];
    }
}
