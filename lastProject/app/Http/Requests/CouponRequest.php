<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CouponRequest extends FormRequest
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
            'code'=>'required|unique:coupons',
            'value'=>'required',
            'quantity'=>'required',
            'condition'=>'required'
        ];
    }
    function messages()
    {
        return [
            'code.required'=>'code Not Null',
            'code.unique'=>'Code is existed',
            'value.required'=>'value Not Null',
            'quantity.required'=>'quantity Not Null',
            'condition.required'=>'condition Not Null',
        ];
    }
}
