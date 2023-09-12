<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostProfessionRequest extends FormRequest
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
            'title' => 'required|string',
            'description' => 'string|nullable',
            'allow_register' => 'boolean',
            'specialtie_id' => 'required|integer|min:1'
        ];
    }
    public function messages()
    {
        [
            'title.required' => 'the title of profession is required',
            'title.string' => 'the title of profession must be string',
            'description.string' => 'the description of profession must be string',
            'allow_register.boolean' => 'the allow register of profession must be boolean',
            'specialtie_id.required' => 'the title of specialtie id is required',
            'specialtie_id.integer' => 'the title of specialtie id must be integer',
            'specialtie_id.min' => 'the specialtie id at laest 1'

        ];
    }
}
