<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBrandProduct extends FormRequest
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
           'sub_category_id' => 'nullable|integer',
           'price_category_id' => 'required|integer',
           'product_age_range_id' => 'required|integer',
           'name' => 'required|string',
           'price' => 'required|integer',
           'gender' => 'required|boolean',
           'image_url' => 'nullable|file|image|max:2048',
         ];
     }

     public function messages()
     {
       return [
         'category_id.required' => 'Please select a category',
        //  'sub_category_id.required' => 'Please select a SubCategory',
         'price_category_id.required' => 'Please select a PriceCategory',
         'product_age_range_id.required' => 'Please select an AgeRange',
       ];
     }

}
