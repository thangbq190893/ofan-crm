<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Returns;
use Illuminate\Http\Request;

class ReturnsController extends Controller
{
    public function index()
    {
        return response()->json(Returns::paginate(15));
    }

    public function store(Request $request)
    {
        $item = Returns::create($request->all());
        return response()->json($item, 201);
    }

    public function show(Returns $return)
    {
        return response()->json($return);
    }

    public function update(Request $request, Returns $return)
    {
        $return->update($request->all());
        return response()->json($return);
    }

    public function destroy(Returns $return)
    {
        $return->delete();
        return response()->json(null, 204);
    }
}
