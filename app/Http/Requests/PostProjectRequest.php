<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostProjectRequest extends FormRequest
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
            'name' => 'required|string|max:100',
            'description' => 'required|max:300',
            'time_first' => 'nullable|date',
            'notes' => 'nullable|string',
            'time_function' => 'nullable|date',
            'additional_file' => 'nullable|file',
            'value' => 'required|integer',
            'funds' => 'nullable|decimal:1',
            'city_id' => 'required|exists:cities,id',
            'description_location' => 'nullable|string|max:200',
            'accept' => 'nullable|in:0,1',
            // 'user_id' => 'required|integer|exists:users,id',
            'worker_id' => 'nullable|integer|exists:workers,id',
            // 'images' => 'nullable|array',
            'images' => 'nullable|image'
        ];
    }
    public function messages()
    {
        return [
            'accept.in' => 'the value must [true,false]or [0,1]',
            'name.max' => 'max name character 100',
            'description.max' => 'max name character 300',
            'funds.decimal' => 'the decimal value must 0.0 formate',
            'city_id.exists' => 'the citie id not found in the table',
            'worker_id.exists' => 'the worker id not found in the table',
            // 'images.image' => 'must array of images'
        ];
    }
}
