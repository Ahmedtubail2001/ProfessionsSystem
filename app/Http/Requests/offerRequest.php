<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class offerRequest extends FormRequest
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
            'project_id' => 'required|exists:projects,id',
            'description' => 'required|max:400',
            'value' => 'required|integer|max:1000000',
            'time' => 'required|integer'
        ];
    }
    public function messages()
    {
        return [
            "required" => "the :attribute field is required",
            "project_id.exists" => "is not exists in projects",
            "value.integer" => "the value must integer",
            "value.max" => ":attribute can't be more than 7 digits ",
            "time.integer" => 'the time must be integer'

        ];
    }
}
