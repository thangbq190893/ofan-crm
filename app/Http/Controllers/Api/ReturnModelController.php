<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\\Models\\ReturnModel as ReturnModelModel;

class ReturnModelController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth:sanctum');
    }

    public function index(Request $request): JsonResponse
    {
        $query = ReturnModelModel::query();

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
        $item = ReturnModelModel::create($data);

        return response()->json($item, 201);
    }

    public function show(ReturnModelModel $returnModel): JsonResponse
    {
        return response()->json($returnModel);
    }

    public function update(Request $request, ReturnModelModel $returnModel): JsonResponse
    {
        $data = $request->all();
        $returnModel->update($data);

        return response()->json($returnModel);
    }

    public function destroy(ReturnModelModel $returnModel): JsonResponse
    {
        $returnModel->delete();
        return response()->json(['message' => 'ReturnModel deleted']);
    }
}
