<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class PostRequestSpecialties extends FormRequest
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
            'title' => 'required|string|min:3|max:44',
            'active' => 'boolean'
            // required|
        ];
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
        [
            'title.required' => 'the title required',
            'title.string' => 'the title must be string',
            'title.min' => 'too short at least 3 character',
            'title.max' => 'too long at more 44 character',
            // 'active.required' => 'the active is required',
            'active.boolean' => 'the active must boolean'
        ];
    }
}
