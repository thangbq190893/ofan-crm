<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Warehouses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WarehousesController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','identify.branch']);
    }

    public function index()
    {
        $branchId = Auth::user()->branch_id ?? session('branch_id');
        $items = Warehouses::when($branchId, function($q) use($branchId) { return $q->where('branch_id', $branchId); })->paginate(15);
        return view('warehouses.index', compact('items'));
    }

    public function create()
    {
        return view('warehouses.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        if (!isset($data['branch_id'])) $data['branch_id'] = Auth::user()->branch_id ?? session('branch_id');
        Warehouses::create($data);
        return redirect()->route('warehouses.index')->with('success', 'Warehouses created.');
    }

    public function show(Warehouses $warehouse)
    {
        return view('warehouses.show', compact('warehouse'));
    }

    public function edit(Warehouses $warehouse)
    {
        return view('warehouses.edit', compact('warehouse'));
    }

    public function update(Request $request, Warehouses $warehouse)
    {
        $warehouse->update($request->all());
        return redirect()->route('warehouses.index')->with('success', 'Warehouses updated.');
    }

    public function destroy(Warehouses $warehouse)
    {
        $warehouse->delete();
        return back()->with('success', 'Warehouses deleted.');
    }
}
