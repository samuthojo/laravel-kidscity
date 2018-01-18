<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AddLocation extends FormRequest
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
            'location' => ['required',
                           'string',
                            Rule::unique('delivery_locations')->where(function ($query) {
                                 return $query->where('deleted_at', null);
                             }),
                           ],
            'delivery_price' => 'required|integer',
        ];
    }

    public function messages()
    {
      return [
        'location.unique' => 'A location with same name exists',
      ];
    }
}
