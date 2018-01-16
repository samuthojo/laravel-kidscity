<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSubCategoryProduct extends FormRequest
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
           'brand_id' => 'required|integer',
           'category_id' => 'required|integer',
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
         'brand_id.required' => 'Please select a brand',
         'category_id.required' => 'Please select a category',
         'price_category_id.required' => 'Please select a PriceCategory',
         'product_age_range_id.required' => 'Please select an AgeRange',
       ];
     }

}