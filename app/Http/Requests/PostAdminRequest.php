<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostAdminRequest extends FormRequest
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
            'email' => 'required|email|string',
            'password' => 'required|string',
            'remember_me' => 'required|boolean',
        ];
    }
    public function messages()
    {
        return [
            'email.required' => 'the email is required',
            'email.email' => 'the email must contain @',
            'email.string' => 'the email must be string ',

            'password.required' => 'the password is required',
            'password.string' => 'the password must be string',
            'password.min' => 'The number of password elements is at least 8',

            'remember_me.required' => 'the remember me is required',
            'remember_me.boolean' => 'the remember me must me boolean',

        ];
    }
}
