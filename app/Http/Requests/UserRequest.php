<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string'],
            'username' => ['required', 'string', 'max:16', 'unique:users,username,except,id'],
            'password' => ['required', 'min:6', 'max:16', 'same:repeat_password'],
            'repeat_password' => ['required', 'same:password']
        ];
    }
}
