<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\CustomerDevices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerDevicesController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','identify.branch']);
    }

    public function index()
    {
        $branchId = Auth::user()->branch_id ?? session('branch_id');
        $items = CustomerDevices::when($branchId, function($q) use($branchId) { return $q->where('branch_id', $branchId); })->paginate(15);
        return view('customer_devices.index', compact('items'));
    }

    public function create()
    {
        return view('customer_devices.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        if (!isset($data['branch_id'])) $data['branch_id'] = Auth::user()->branch_id ?? session('branch_id');
        CustomerDevices::create($data);
        return redirect()->route('customer_devices.index')->with('success', 'CustomerDevices created.');
    }

    public function show(CustomerDevices $customer_device)
    {
        return view('customer_devices.show', compact('customer_device'));
    }

    public function edit(CustomerDevices $customer_device)
    {
        return view('customer_devices.edit', compact('customer_device'));
    }

    public function update(Request $request, CustomerDevices $customer_device)
    {
        $customer_device->update($request->all());
        return redirect()->route('customer_devices.index')->with('success', 'CustomerDevices updated.');
    }

    public function destroy(CustomerDevices $customer_device)
    {
        $customer_device->delete();
        return back()->with('success', 'CustomerDevices deleted.');
    }
}
