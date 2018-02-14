<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateProduct extends FormRequest
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
        $rules = [
            'name' => ['required',
                       'string',
                        Rule::unique('products')->where(function ($query) {
                             return $query->where('deleted_at', null);
                         }),
                       ],
            'price' => 'required|integer',
            'sale_price' => 'nullable|integer',
            'code' => 'nullable|string',
            'barcode' => 'nullable|string',
            'weight' => 'nullable|string',
            'dimensions' => 'nullable|string',
            'stock' => 'required|integer',
            'gender' => 'nullable|integer',
            'video_url' => 'nullable|url',
        ];
        $brand_id = count($this->input('brand_id')) - 1;
        foreach(range(0, $brand_id) as $index) {
            $rules['brand_id.' . $index] =
              ($index) ? 'required|integer' : 'nullable|integer';
        }
        $category_id = count($this->input('category_id')) - 1;
        foreach(range(0, $category_id) as $index) {
            $rules['category_id.' . $index] =
              ($index) ? 'required|integer' : 'nullable|integer';
        }
        $sub_category_id = count($this->input('sub_category_id')) - 1;
        foreach(range(0, $sub_category_id) as $index) {
            $rules['sub_category_id.' . $index] = 'nullable|integer';
        }
        $product_age_range_id = count($this->input('product_age_range_id')) - 1;
        foreach(range(0, $product_age_range_id) as $index) {
            $rules['product_age_range_id.' . $index] =
              ($index) ? 'required|integer' : 'nullable|integer';
        }
        $product_size_id = count($this->input('product_size_id')) - 1;
        foreach(range(0, $product_size_id) as $index) {
            $rules['product_size_id.' . $index] = 'nullable|integer';
        }
        $price_category_id = count($this->input('price_category_id')) - 1;
        foreach(range(0, $price_category_id) as $index) {
            $rules['price_category_id.' . $index] =
              ($index) ? 'required|integer' : 'nullable|integer';
        }
        $image_url = count($this->input('image_url')) - 1;
        foreach(range(0, $image_url) as $index) {
            $rules['image_url.' . $index] = 'nullable|file|image|max:2048';
        }
        return $rules;
    }

    public function messages()
    {
      return [
        'brand_id.required' => 'Please select a brand',
        'category_id.required' => 'Please select a category',
        // 'sub_category_id.required' => 'Please select a SubCategory',
        'price_category_id.required' => 'Please select a PriceCategory',
        'product_age_range_id.required' => 'Please select an AgeRange',
        'name.unique' => 'A product with same name exists',
      ];
    }
}
