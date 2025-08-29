<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductsRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return {
        "sku": "required|string|max:50|unique:products,sku",
        "name": "required|string|max:150",
        "category_id": "required|exists:product_categories,id",
        "default_price": "required|numeric|min:0"
};
    }
}
