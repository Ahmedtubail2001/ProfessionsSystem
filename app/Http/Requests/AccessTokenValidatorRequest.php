<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AccessTokenValidatorRequest extends FormRequest
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
        return
            [
                'email' => 'required|email|max:255|exists:users,email',
                'password' => 'required|string|max:255',
                'device_name' => 'string|max:255'


            ];
    }
    public function messages()
    {
        return  [
            "email.required" => "the email is requireds",
            "email.email" => "The entry must be an email",
            "email.exists" => "the email is not exists in register data"
        ];
    }
}
