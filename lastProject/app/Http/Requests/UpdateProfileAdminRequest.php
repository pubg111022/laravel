<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileAdminRequest extends FormRequest
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
            'name'=>'required',
            'password'=>'required|min:6',
            'phone'=>'required',
            'address'=>'required'
        ];
    }
    function messages()
    {
        return [
            'name.required'=>'Name Can Not Null',
            'password.required'=>'password Can Not Null',
            'phone.required'=>'phone Can Not Null',
            'address.required'=>'address Can Not Null',
            'password.min'=>'Password must be greater than 6 character ',
        ];
    }
}
