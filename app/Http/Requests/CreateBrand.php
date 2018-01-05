<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
             'name' => 'required|unique:brands',
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
