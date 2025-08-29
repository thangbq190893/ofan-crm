<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InventoryMovementsRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return {
        "inventory_id": "required|exists:inventory,id",
        "type": "required|in:IN,OUT,ADJUST",
        "qty": "required|integer|not_in:0"
};
    }
}
