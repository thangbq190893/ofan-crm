<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Receipts;
use Illuminate\Http\Request;

class ReceiptsController extends Controller
{
    public function index()
    {
        return response()->json(Receipts::paginate(15));
    }

    public function store(Request $request)
    {
        $item = Receipts::create($request->all());
        return response()->json($item, 201);
    }

    public function show(Receipts $receipt)
    {
        return response()->json($receipt);
    }

    public function update(Request $request, Receipts $receipt)
    {
        $receipt->update($request->all());
        return response()->json($receipt);
    }

    public function destroy(Receipts $receipt)
    {
        $receipt->delete();
        return response()->json(null, 204);
    }
}
