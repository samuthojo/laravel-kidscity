<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreatePriceCategory extends FormRequest
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
          'range' => ['required',
                      Rule::unique('price_categories')->where(function ($query) {
                           return $query->where('deleted_at', null);
                       }),
                     ],
        ];
    }

    public function messages()
    {
      return [
        'range.unique' => 'The entered price range exists',
      ];
    }
}
