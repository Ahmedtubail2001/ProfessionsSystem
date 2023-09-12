<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CityRequest extends FormRequest
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
            'name' => 'required|max:255|unique:cities,name'
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'the name is required !',
            'name.max' => 'maximum number of characters is 255!',
            'name.unique' => 'name of cities is already exists',
        ];
    }
}
