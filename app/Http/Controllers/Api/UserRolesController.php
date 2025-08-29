<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\UserRoles;
use Illuminate\Http\Request;

class UserRolesController extends Controller
{
    public function index()
    {
        return response()->json(UserRoles::paginate(15));
    }

    public function store(Request $request)
    {
        $item = UserRoles::create($request->all());
        return response()->json($item, 201);
    }

    public function show(UserRoles $user_role)
    {
        return response()->json($user_role);
    }

    public function update(Request $request, UserRoles $user_role)
    {
        $user_role->update($request->all());
        return response()->json($user_role);
    }

    public function destroy(UserRoles $user_role)
    {
        $user_role->delete();
        return response()->json(null, 204);
    }
}
