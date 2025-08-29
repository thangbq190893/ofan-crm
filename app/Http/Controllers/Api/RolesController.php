<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Roles;
use Illuminate\Http\Request;

class RolesController extends Controller
{
    public function index()
    {
        return response()->json(Roles::paginate(15));
    }

    public function store(Request $request)
    {
        $item = Roles::create($request->all());
        return response()->json($item, 201);
    }

    public function show(Roles $role)
    {
        return response()->json($role);
    }

    public function update(Request $request, Roles $role)
    {
        $role->update($request->all());
        return response()->json($role);
    }

    public function destroy(Roles $role)
    {
        $role->delete();
        return response()->json(null, 204);
    }
}
