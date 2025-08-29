<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\InventoryMovements;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InventoryMovementsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','identify.branch']);
    }

    public function index()
    {
        $branchId = Auth::user()->branch_id ?? session('branch_id');
        $items = InventoryMovements::when($branchId, function($q) use($branchId) { return $q->where('branch_id', $branchId); })->paginate(15);
        return view('inventory_movements.index', compact('items'));
    }

    public function create()
    {
        return view('inventory_movements.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        if (!isset($data['branch_id'])) $data['branch_id'] = Auth::user()->branch_id ?? session('branch_id');
        InventoryMovements::create($data);
        return redirect()->route('inventory_movements.index')->with('success', 'InventoryMovements created.');
    }

    public function show(InventoryMovements $inventory_movement)
    {
        return view('inventory_movements.show', compact('inventory_movement'));
    }

    public function edit(InventoryMovements $inventory_movement)
    {
        return view('inventory_movements.edit', compact('inventory_movement'));
    }

    public function update(Request $request, InventoryMovements $inventory_movement)
    {
        $inventory_movement->update($request->all());
        return redirect()->route('inventory_movements.index')->with('success', 'InventoryMovements updated.');
    }

    public function destroy(InventoryMovements $inventory_movement)
    {
        $inventory_movement->delete();
        return back()->with('success', 'InventoryMovements deleted.');
    }
}
