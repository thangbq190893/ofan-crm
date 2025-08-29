<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\OrderItems;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderItemsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','identify.branch']);
    }

    public function index()
    {
        $branchId = Auth::user()->branch_id ?? session('branch_id');
        $items = OrderItems::when($branchId, function($q) use($branchId) { return $q->where('branch_id', $branchId); })->paginate(15);
        return view('order_items.index', compact('items'));
    }

    public function create()
    {
        return view('order_items.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        if (!isset($data['branch_id'])) $data['branch_id'] = Auth::user()->branch_id ?? session('branch_id');
        OrderItems::create($data);
        return redirect()->route('order_items.index')->with('success', 'OrderItems created.');
    }

    public function show(OrderItems $order_item)
    {
        return view('order_items.show', compact('order_item'));
    }

    public function edit(OrderItems $order_item)
    {
        return view('order_items.edit', compact('order_item'));
    }

    public function update(Request $request, OrderItems $order_item)
    {
        $order_item->update($request->all());
        return redirect()->route('order_items.index')->with('success', 'OrderItems updated.');
    }

    public function destroy(OrderItems $order_item)
    {
        $order_item->delete();
        return back()->with('success', 'OrderItems deleted.');
    }
}
