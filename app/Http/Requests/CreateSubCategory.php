<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'name' => ['required',
                        Rule::unique('sub_categories')->where(function ($query) {
                             return $query->where('deleted_at', null);
                         }),
                       ],
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
