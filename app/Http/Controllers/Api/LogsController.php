<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Logs;
use Illuminate\Http\Request;

class LogsController extends Controller
{
    public function index()
    {
        return response()->json(Logs::paginate(15));
    }

    public function store(Request $request)
    {
        $item = Logs::create($request->all());
        return response()->json($item, 201);
    }

    public function show(Logs $log)
    {
        return response()->json($log);
    }

    public function update(Request $request, Logs $log)
    {
        $log->update($request->all());
        return response()->json($log);
    }

    public function destroy(Logs $log)
    {
        $log->delete();
        return response()->json(null, 204);
    }
}
