<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AccountRequest extends FormRequest
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
            'email'=>'required|unique:users|max:255|min:5',
            'password'=>'required|max:255|min:6',
            'cf_password'=>'same:password'
        ];
    }
    function messages()
    {
        return [
            'name.required'=>'Name  Not Null',
            'email.unique'=>'Email is existed',
            'password.required'=>'password not null',
            'password.min'=>'Password must be greater than 6 character ',
            'cf_password.same'=>'Confirm Password incorrect'
        ];
    }
}
