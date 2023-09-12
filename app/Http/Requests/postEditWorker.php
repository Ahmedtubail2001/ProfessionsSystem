<?php

namespace App\Http\Requests;

use App\Models\Worker;
use Illuminate\Foundation\Http\FormRequest;

class postEditWorker extends FormRequest
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
        //  ['professional_experience', 'cover_image', 'id_number', 'address', 'experience-year', 'password', 'user_id', 'profession_id'];
        $slug = $this->route('slug', 0);
        $worker = Worker::where('slug', $slug)->with('user')->first();
        $rule = [
            //
            'professional_experience' => 'required|string',
            'id_number' => 'required|numeric|digits_between:7,12',
            'address' => 'required|string',
            'experience_year' => 'required|min:1',
            // 'password' => 'required|min:6',
            // 'user_id' => 'required|min:1',
            'profession_id' => 'required|min:1',
            'phone_number' => 'required|regex:/^\+\d+/',
            // 'email' => 'nullable|email|unique:users,email,' . $worker->user->id,
            'name' => 'required',
            'city_id' => 'nullable|exists:cities,id'

        ];
        if ($worker && $worker->user) {
            $rules['email'] = 'nullable|email|unique:users,email,' . $worker->user->id;
        }
        return $rule;
    }
    public function messages()
    {
        return [
            'professional_experience.required' => 'the professional experience is required',
            'professional_experience.string' => 'the professional experience must be string',
            'cover_image.required' => 'the cover image is required',
            // 'cover_image.mimes' => 'Allowed image types jpg,png,jpeg,gif,svg',
            'cover_image.base64image' => 'the image must Base64 input and the size [maxWidth = 3000 ,maxHeight = 2000,minWidth = 600 ,  minHeight = 500]',
            'cover_image.max' => 'the max image size = 2048',
            'id_number.required' => 'the ID Number is required',
            'id_number.numeric' => 'the ID Number must number',
            'id_number.digits' => 'the digit phone must be 10 digits ',
            'address.required' => 'the address is required',
            'address.string' => 'the address must be string',
            'experience_year.required' => 'the experience year is required',
            'experience_year.min' => 'minimum number experience year is 1',
            'password.required' => 'the password is required',
            'password.min' => 'Password must consist of at least 6 characters',
            'user_id.required' => 'the password is required ',
            'user_id.min' => 'minimum number user id is 1 ',
            'profession_id.required' => 'the profession id is required ',
            'profession_id.min' => 'minimum number profession id is 1 ',
            'phone_number.required' => 'the phone number is required',
            'phone_number.regex' => 'The phone number must start with a + sign followed by 4 to 15 numbers.',
            'city_id.exists' => 'sory !! the city not exists in the website',
            "name.required" => "Name is required.",
            "email.unique" => "This email already exists in our database!",
        ];
    }
}
