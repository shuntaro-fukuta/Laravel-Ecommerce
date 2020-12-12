<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:30',
            'email' => 'required|string|email|max:255|unique:users',
            'address' => 'required|max:200',
            'phone_number' => 'required|numeric|digits_between:8,11',
            'password' => 'required|string|min:8|confirmed',
        ];
    }
}
