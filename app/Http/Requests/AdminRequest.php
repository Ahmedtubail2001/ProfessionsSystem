<?php

namespace App\Http\Requests;

use App\Models\Admin;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class AdminRequest extends FormRequest
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
        $admin = Admin::find($this->route('admin', 0));;
        $id = $admin ? $admin->id : 0;

        return [
            'name' => 'required',
            'email' => 'required|unique:admins,email,' . $id,
            'password' => $this->route('admin') ? 'nullable|min:8' : 'required|min:8',
            'role_name' => ['required', Rule::in(['normal admin', 'hight level admin'])]
        ];
    }
    public function messages()
    {
        return [
            'required' => ':attribute is required',
            'email.unique' => 'the :attribute is already exists',
            'role_name.in' => 'The role name must be normal or hight level ',
            'password.min' => 'the password at least 8 character'
        ];
    }
}
