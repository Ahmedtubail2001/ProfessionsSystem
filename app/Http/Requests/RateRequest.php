<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RateRequest extends FormRequest
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
            'comment' => 'nullable|max:200',
            'rate' => 'required|integer|between:0,10',
            'accept' => 'nullable|max:1',
            'worker_id' => 'required|exists:workers,id'
        ];
    }
    public function messages(): array
    {
        return [
            '*.required' => 'this :attribute is required',
            'comment.max' => 'the maximun :attribute is 200',
            'accept.max' => 'the maximun :attribute is 1',
            'rate.integer' => 'the :attribute must integer . ',
            'rate.between' => 'the :attribute must between 0 , 10',
            'worker_id.unique' => 'you have already evaluated',
        ];
    }
}
