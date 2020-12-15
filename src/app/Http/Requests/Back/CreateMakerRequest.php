<?php

namespace App\Http\Requests\Back;

use Illuminate\Foundation\Http\FormRequest;

class CreateMakerRequest extends FormRequest
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
            'name' => 'required|string|max:50',
            'email' => 'required|string|email|max:255|unique:makers',
            'address' => 'required|max:200',
            'phone_number' => 'required|numeric|digits_between:8,11',
        ];
    }
}
