<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'product_ids'   => 'required|array|min:1',
            'product_ids.*' => 'required|integer|exists:products,id',
            'quantities'    => 'required|array|min:1',
            'quantities.*'  => 'required|integer|min:1'
        ];
    }
}
