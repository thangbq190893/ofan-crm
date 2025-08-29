<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PaymentMethods;
use Illuminate\Http\Request;

class PaymentMethodsController extends Controller
{
    public function index()
    {
        return response()->json(PaymentMethods::paginate(15));
    }

    public function store(Request $request)
    {
        $item = PaymentMethods::create($request->all());
        return response()->json($item, 201);
    }

    public function show(PaymentMethods $payment_method)
    {
        return response()->json($payment_method);
    }

    public function update(Request $request, PaymentMethods $payment_method)
    {
        $payment_method->update($request->all());
        return response()->json($payment_method);
    }

    public function destroy(PaymentMethods $payment_method)
    {
        $payment_method->delete();
        return response()->json(null, 204);
    }
}
