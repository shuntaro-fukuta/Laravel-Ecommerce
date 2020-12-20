<?php

namespace App\Http\Requests\Back;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
            'category_id' => 'required|integer|exists:categories,id',
            'maker_id' => 'required|exists:makers,id',
            'name' => 'required|string|max:100',
            'price' => 'required|min:0|max:999999',
            'image_url' => 'nullable|url',
            'description' => 'nullable|max:255',
            'is_published' => 'required|boolean',
        ];
    }
}
