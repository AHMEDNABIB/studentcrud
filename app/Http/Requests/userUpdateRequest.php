<?php

namespace App\Http\Requests;
use  App\Models\User;
use Illuminate\Validation\Rules;

use Illuminate\Foundation\Http\FormRequest;

class userUpdateRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
           
             'password' => 'nullable|confirmed|min:6',
             'email'=>'required|string|email|max:255|unique:users',
            'first_name'=> 'required|max:25',
            'last_name'=> 'required|max:25',
            'mobile'=> 'required|numeric',
            'address'=> 'required|max:50',
            'post_code'=> 'required|digits:5',
             'image'=> 'mimes:jpeg,png,jpg,gif,svg|max:2048'
        ];
    }
}
