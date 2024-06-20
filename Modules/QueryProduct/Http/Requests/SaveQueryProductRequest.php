<?php

namespace Modules\QueryProduct\Http\Requests;

use Illuminate\Validation\Rule;
use Modules\Core\Http\Requests\Request;

class SaveQueryProductRequest extends Request
{
    /**
     * Available attributes.
     *
     * @var string
     */
    protected $availableAttributes = 'queryproduct::attributes';

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'campaign_name' => ['required'],
            'products.*.product_id' => ['required', Rule::exists('products', 'id')],
            'products.*.end_date' => ['required', 'date'],
            'products.*.price' => ['required', 'numeric', 'min:0', 'max:99999999999999'],
            'products.*.qty' => ['required', 'numeric', 'min:0'],
        ];
    }
}
