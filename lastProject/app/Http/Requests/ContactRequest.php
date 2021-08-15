<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
            'name' => 'required',
            'email' => 'required',
            'phone'=>'required',
            'comment'=>'required'
        ];
    }
    public function messages()
    {
        return [
            'name.required'=>'Name can not Null',
            'email.required'=>'Email can not null',
            'phone.required'=>'Phone can not null',
            'comment.required'=>'Comment can not null'
        ];
    }
}
