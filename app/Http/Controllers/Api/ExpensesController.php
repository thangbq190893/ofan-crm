<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Expenses;
use Illuminate\Http\Request;

class ExpensesController extends Controller
{
    public function index()
    {
        return response()->json(Expenses::paginate(15));
    }

    public function store(Request $request)
    {
        $item = Expenses::create($request->all());
        return response()->json($item, 201);
    }

    public function show(Expenses $expense)
    {
        return response()->json($expense);
    }

    public function update(Request $request, Expenses $expense)
    {
        $expense->update($request->all());
        return response()->json($expense);
    }

    public function destroy(Expenses $expense)
    {
        $expense->delete();
        return response()->json(null, 204);
    }
}
