<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ReturnItems;
use Illuminate\Http\Request;

class ReturnItemsController extends Controller
{
    public function index()
    {
        return response()->json(ReturnItems::paginate(15));
    }

    public function store(Request $request)
    {
        $item = ReturnItems::create($request->all());
        return response()->json($item, 201);
    }

    public function show(ReturnItems $return_item)
    {
        return response()->json($return_item);
    }

    public function update(Request $request, ReturnItems $return_item)
    {
        $return_item->update($request->all());
        return response()->json($return_item);
    }

    public function destroy(ReturnItems $return_item)
    {
        $return_item->delete();
        return response()->json(null, 204);
    }
}
