<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateSubCategory extends FormRequest
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
            'category_id' => 'required|integer',
            'name' => 'required|unique:sub_categories',
        ];
    }

    public function messages()
    {
        return [
          'category_id.required' => 'Please choose a category',
          'name.unique' => 'A SubCategory with same name exists',
        ];
    }
}
