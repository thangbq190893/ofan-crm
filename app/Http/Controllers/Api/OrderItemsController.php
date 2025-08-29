<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\OrderItems;
use Illuminate\Http\Request;

class OrderItemsController extends Controller
{
    public function index()
    {
        return response()->json(OrderItems::paginate(15));
    }

    public function store(Request $request)
    {
        $item = OrderItems::create($request->all());
        return response()->json($item, 201);
    }

    public function show(OrderItems $order_item)
    {
        return response()->json($order_item);
    }

    public function update(Request $request, OrderItems $order_item)
    {
        $order_item->update($request->all());
        return response()->json($order_item);
    }

    public function destroy(OrderItems $order_item)
    {
        $order_item->delete();
        return response()->json(null, 204);
    }
}
