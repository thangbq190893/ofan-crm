<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\\Models\\Inventory as InventoryModel;

class InventoryController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth:sanctum');
    }

    public function index(Request $request): JsonResponse
    {
        $query = InventoryModel::query();

        if ($search = $request->get('q')) {
            $query->where(function ($q) use ($search) {
                $q->where('id', $search);
            });
        }

        $items = $query->latest()->paginate($request->get('per_page', 15));
        return response()->json($items);
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->all();
        $item = InventoryModel::create($data);

        return response()->json($item, 201);
    }

    public function show(InventoryModel $inventory): JsonResponse
    {
        return response()->json($inventory);
    }

    public function update(Request $request, InventoryModel $inventory): JsonResponse
    {
        $data = $request->all();
        $inventory->update($data);

        return response()->json($inventory);
    }

    public function destroy(InventoryModel $inventory): JsonResponse
    {
        $inventory->delete();
        return response()->json(['message' => 'Inventory deleted']);
    }
}
