<?php
namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        return response()->json(Customer::all());
    }
    public function store(Request $request)
    {
        $data = $request->all();
        $record = Customer::create($data);
        return response()->json($record, 201);
    }
    public function show(Customer $item)
    {
        return response()->json($item);
    }
    public function update(Request $request, Customer $item)
    {
        $item->update($request->all());
        return response()->json($item);
    }
    public function destroy(Customer $item)
    {
        $item->delete();
        return response()->json(null, 204);
    }
}
