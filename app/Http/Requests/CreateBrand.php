<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateBrand extends FormRequest
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
                         Rule::unique('brands')->where(function ($query) {
                              return $query->where('deleted_at', null);
                          }),
                        ],
             'image_url' =>  'nullable|file|image|max:2048',
         ];
     }

     public function messages()
     {
         return [
           'name.unique' => 'A brand with same name exists',
         ];
     }
}
