<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateCategory extends FormRequest
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
          'name' => ['required',
                      Rule::unique('categories')->where(function ($query) {
                           return $query->where('deleted_at', null);
                       }),
                     ],
        ];
    }

    public function messages()
    {
      return [
        'name.unique' => 'A category with the same name exists',
      ];
    }
}
