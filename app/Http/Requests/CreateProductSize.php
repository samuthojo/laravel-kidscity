<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateProductSize extends FormRequest
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
            'size' => [
              'required',
              Rule::unique('product_sizes')
                  ->ignore($this->input('id'))
                  ->where(function ($query) {
                        return $query->where('deleted_at', null);
                    }),
        ],
      ];
    }

    public function messages()
    {
      return [
        'size.unique' => 'This size already exists',
      ];
    }
}
