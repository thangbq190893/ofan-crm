<?php
namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        return response()->json(Order::all());
    }
    public function store(Request $request)
    {
        $data = $request->all();
        $record = Order::create($data);
        return response()->json($record, 201);
    }
    public function show(Order $item)
    {
        return response()->json($item);
    }
    public function update(Request $request, Order $item)
    {
        $item->update($request->all());
        return response()->json($item);
    }
    public function destroy(Order $item)
    {
        $item->delete();
        return response()->json(null, 204);
    }
}
