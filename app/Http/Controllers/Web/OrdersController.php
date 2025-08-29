<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrdersController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','identify.branch']);
    }

    public function index()
    {
        $branchId = Auth::user()->branch_id ?? session('branch_id');
        $items = Order::when($branchId, function($q) use($branchId) { return $q->where('branch_id', $branchId); })->paginate(15);
        return view('orders.index', compact('items'));
    }

    public function create()
    {
        return view('orders.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        if (!isset($data['branch_id'])) $data['branch_id'] = Auth::user()->branch_id ?? session('branch_id');
        Order::create($data);
        return redirect()->route('orders.index')->with('success', 'Orders created.');
    }

    public function show(Order $order)
    {
        return view('orders.show', compact('order'));
    }

    public function edit(Order $order)
    {
        return view('orders.edit', compact('order'));
    }

    public function update(Request $request, Order $order)
    {
        $order->update($request->all());
        return redirect()->route('orders.index')->with('success', 'Orders updated.');
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return back()->with('success', 'Orders deleted.');
    }
}
