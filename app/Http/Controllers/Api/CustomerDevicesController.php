<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CustomerDevices;
use Illuminate\Http\Request;

class CustomerDevicesController extends Controller
{
    public function index()
    {
        return response()->json(CustomerDevices::paginate(15));
    }

    public function store(Request $request)
    {
        $item = CustomerDevices::create($request->all());
        return response()->json($item, 201);
    }

    public function show(CustomerDevices $customer_device)
    {
        return response()->json($customer_device);
    }

    public function update(Request $request, CustomerDevices $customer_device)
    {
        $customer_device->update($request->all());
        return response()->json($customer_device);
    }

    public function destroy(CustomerDevices $customer_device)
    {
        $customer_device->delete();
        return response()->json(null, 204);
    }
}
