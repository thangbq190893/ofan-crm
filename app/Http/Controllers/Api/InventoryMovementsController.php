<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\InventoryMovements;
use Illuminate\Http\Request;

class InventoryMovementsController extends Controller
{
    public function index()
    {
        return response()->json(InventoryMovements::paginate(15));
    }

    public function store(Request $request)
    {
        $item = InventoryMovements::create($request->all());
        return response()->json($item, 201);
    }

    public function show(InventoryMovements $inventory_movement)
    {
        return response()->json($inventory_movement);
    }

    public function update(Request $request, InventoryMovements $inventory_movement)
    {
        $inventory_movement->update($request->all());
        return response()->json($inventory_movement);
    }

    public function destroy(InventoryMovements $inventory_movement)
    {
        $inventory_movement->delete();
        return response()->json(null, 204);
    }
}
