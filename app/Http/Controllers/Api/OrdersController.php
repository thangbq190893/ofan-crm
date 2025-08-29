<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Orders;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function index()
    {
        return response()->json(Orders::paginate(15));
    }

    public function store(Request $request)
    {
        $item = Orders::create($request->all());
        return response()->json($item, 201);
    }

    public function show(Orders $order)
    {
        return response()->json($order);
    }

    public function update(Request $request, Orders $order)
    {
        $order->update($request->all());
        return response()->json($order);
    }

    public function destroy(Orders $order)
    {
        $order->delete();
        return response()->json(null, 204);
    }
}
