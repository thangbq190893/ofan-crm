<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Users;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index()
    {
        return response()->json(Users::paginate(15));
    }

    public function store(Request $request)
    {
        $item = Users::create($request->all());
        return response()->json($item, 201);
    }

    public function show(Users $user)
    {
        return response()->json($user);
    }

    public function update(Request $request, Users $user)
    {
        $user->update($request->all());
        return response()->json($user);
    }

    public function destroy(Users $user)
    {
        $user->delete();
        return response()->json(null, 204);
    }
}
