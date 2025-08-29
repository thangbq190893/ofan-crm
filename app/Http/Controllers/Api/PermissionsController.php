<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Permissions;
use Illuminate\Http\Request;

class PermissionsController extends Controller
{
    public function index()
    {
        return response()->json(Permissions::paginate(15));
    }

    public function store(Request $request)
    {
        $item = Permissions::create($request->all());
        return response()->json($item, 201);
    }

    public function show(Permissions $permission)
    {
        return response()->json($permission);
    }

    public function update(Request $request, Permissions $permission)
    {
        $permission->update($request->all());
        return response()->json($permission);
    }

    public function destroy(Permissions $permission)
    {
        $permission->delete();
        return response()->json(null, 204);
    }
}
