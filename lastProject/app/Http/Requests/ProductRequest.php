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
            'name'=>'required|max:255',
            'price'=>'required',
            'sale_price'=>'lt:price'
        ];
    }
    function messages()
    {
        return [
            'name.required'=>'Name not null',
            'name.max'=>'Name can not be greater than 255 character',
            'price.required'=>'Price not null',
        ];
    }
}
