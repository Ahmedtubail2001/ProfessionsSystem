<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class customerRequest extends FormRequest
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
            'Whatsapp_number' => 'nullable|integer',
            'id_number' => 'nullable|integer',
            'birthDate' => 'nullable|date',
            'gender' => 'nullable|in:Male,Female',
            'address' => 'nullable|string',
            'slug' => 'nullable|string'
        ];
    }
    public function messages()
    {
        return [
            'Whatsapp_number.integer' => 'the whats number must integer',
            'Whatsapp_number.max' => 'the whats number max 15',
            'id_number.integer'  => 'the id number must integer',
            'id_number.max'  => 'the id number max 15',
            'birthDate.date' => 'birthDate must date type',
            'gender.in' => 'must be Male or Female ',
            'address.required' => "Address field can't empty",


        ];
    }
}
