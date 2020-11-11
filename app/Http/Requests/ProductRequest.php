<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'categories'   => 'required|array|min:1',
            'categories.*' => 'required|exists:categories,name',
            'name'         => 'required|unique:products',
            'quantity'     => 'required|integer|min:1',
            'image'        => 'nullable|image|max:10240',
            'price'        => 'required|numeric|min:0.01',
            'discount'     => 'nullable|numeric|min:0.01'
        ];
    }
}
