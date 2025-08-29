<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Payments;
use Illuminate\Http\Request;

class PaymentsController extends Controller
{
    public function index()
    {
        return response()->json(Payments::paginate(15));
    }

    public function store(Request $request)
    {
        $item = Payments::create($request->all());
        return response()->json($item, 201);
    }

    public function show(Payments $payment)
    {
        return response()->json($payment);
    }

    public function update(Request $request, Payments $payment)
    {
        $payment->update($request->all());
        return response()->json($payment);
    }

    public function destroy(Payments $payment)
    {
        $payment->delete();
        return response()->json(null, 204);
    }
}
