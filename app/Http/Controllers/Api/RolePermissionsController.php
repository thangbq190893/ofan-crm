<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\RolePermissions;
use Illuminate\Http\Request;

class RolePermissionsController extends Controller
{
    public function index()
    {
        return response()->json(RolePermissions::paginate(15));
    }

    public function store(Request $request)
    {
        $item = RolePermissions::create($request->all());
        return response()->json($item, 201);
    }

    public function show(RolePermissions $role_permission)
    {
        return response()->json($role_permission);
    }

    public function update(Request $request, RolePermissions $role_permission)
    {
        $role_permission->update($request->all());
        return response()->json($role_permission);
    }

    public function destroy(RolePermissions $role_permission)
    {
        $role_permission->delete();
        return response()->json(null, 204);
    }
}
