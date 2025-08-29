<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\\Models\\LogEntry as LogEntryModel;

class LogEntryController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth:sanctum');
    }

    public function index(Request $request): JsonResponse
    {
        $query = LogEntryModel::query();

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
        $item = LogEntryModel::create($data);

        return response()->json($item, 201);
    }

    public function show(LogEntryModel $logEntry): JsonResponse
    {
        return response()->json($logEntry);
    }

    public function update(Request $request, LogEntryModel $logEntry): JsonResponse
    {
        $data = $request->all();
        $logEntry->update($data);

        return response()->json($logEntry);
    }

    public function destroy(LogEntryModel $logEntry): JsonResponse
    {
        $logEntry->delete();
        return response()->json(['message' => 'LogEntry deleted']);
    }
}
