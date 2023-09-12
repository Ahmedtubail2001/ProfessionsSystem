<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class PostAboutRequest extends FormRequest
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
            'name' => 'required|string',
            'title' => 'required|string',
            'image' => 'required'

        ];
        // if ($this->wantsJson()) {    
        //     $rules[] = ['device_name' => 'required'];
        // }

        // return $rules;
    }


    public function failedValidation(Validator $validator)

    {

        throw new HttpResponseException(response()->json([

            'success'   => false,

            'message'   => 'Validation errors',

            'data'      => $validator->errors()

        ]));
    }


    public function messages()
    {
        return [
            'title.required' => 'title required',
            'title.string' => 'title required',
            'image.required' => 'image required'
        ];
    }
}
