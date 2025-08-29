<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Branches;
use Illuminate\Http\Request;

class BranchesController extends Controller
{
    public function index()
    {
        return response()->json(Branches::paginate(15));
    }

    public function store(Request $request)
    {
        $item = Branches::create($request->all());
        return response()->json($item, 201);
    }

    public function show(Branches $branche)
    {
        return response()->json($branche);
    }

    public function update(Request $request, Branches $branche)
    {
        $branche->update($request->all());
        return response()->json($branche);
    }

    public function destroy(Branches $branche)
    {
        $branche->delete();
        return response()->json(null, 204);
    }
}
