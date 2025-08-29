<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrdersRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return {
        "code": "required|string|unique:orders,code",
        "customer_id": "required|exists:customers,id",
        "branch_id": "required|exists:branches,id"
};
    }
}
