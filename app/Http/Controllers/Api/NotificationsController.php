<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Notifications;
use Illuminate\Http\Request;

class NotificationsController extends Controller
{
    public function index()
    {
        return response()->json(Notifications::paginate(15));
    }

    public function store(Request $request)
    {
        $item = Notifications::create($request->all());
        return response()->json($item, 201);
    }

    public function show(Notifications $notification)
    {
        return response()->json($notification);
    }

    public function update(Request $request, Notifications $notification)
    {
        $notification->update($request->all());
        return response()->json($notification);
    }

    public function destroy(Notifications $notification)
    {
        $notification->delete();
        return response()->json(null, 204);
    }
}
