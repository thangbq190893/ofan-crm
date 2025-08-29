<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Customers;
use Illuminate\Http\Request;

class CustomersController extends Controller
{
    public function index()
    {
        return response()->json(Customers::paginate(15));
    }

    public function store(Request $request)
    {
        $item = Customers::create($request->all());
        return response()->json($item, 201);
    }

    public function show(Customers $customer)
    {
        return response()->json($customer);
    }

    public function update(Request $request, Customers $customer)
    {
        $customer->update($request->all());
        return response()->json($customer);
    }

    public function destroy(Customers $customer)
    {
        $customer->delete();
        return response()->json(null, 204);
    }
}
