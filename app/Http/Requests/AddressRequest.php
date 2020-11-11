<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddressRequest extends FormRequest
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
            'city_id'     => 'required|integer|exists:cities,id',
            'address'     => 'required|alpha_dash',
            'apartment'   => 'required|alpha',
            'postal_code' => 'required|alpha_dash|min:5|max:10',
        ];
    }
}
