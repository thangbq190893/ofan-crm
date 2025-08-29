<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Warehouses;
use Illuminate\Http\Request;

class WarehousesController extends Controller
{
    public function index()
    {
        return response()->json(Warehouses::paginate(15));
    }

    public function store(Request $request)
    {
        $item = Warehouses::create($request->all());
        return response()->json($item, 201);
    }

    public function show(Warehouses $warehouse)
    {
        return response()->json($warehouse);
    }

    public function update(Request $request, Warehouses $warehouse)
    {
        $warehouse->update($request->all());
        return response()->json($warehouse);
    }

    public function destroy(Warehouses $warehouse)
    {
        $warehouse->delete();
        return response()->json(null, 204);
    }
}
