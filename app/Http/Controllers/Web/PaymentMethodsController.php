<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\PaymentMethods;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentMethodsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','identify.branch']);
    }

    public function index()
    {
        $branchId = Auth::user()->branch_id ?? session('branch_id');
        $items = PaymentMethods::when($branchId, function($q) use($branchId) { return $q->where('branch_id', $branchId); })->paginate(15);
        return view('payment_methods.index', compact('items'));
    }

    public function create()
    {
        return view('payment_methods.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        if (!isset($data['branch_id'])) $data['branch_id'] = Auth::user()->branch_id ?? session('branch_id');
        PaymentMethods::create($data);
        return redirect()->route('payment_methods.index')->with('success', 'PaymentMethods created.');
    }

    public function show(PaymentMethods $payment_method)
    {
        return view('payment_methods.show', compact('payment_method'));
    }

    public function edit(PaymentMethods $payment_method)
    {
        return view('payment_methods.edit', compact('payment_method'));
    }

    public function update(Request $request, PaymentMethods $payment_method)
    {
        $payment_method->update($request->all());
        return redirect()->route('payment_methods.index')->with('success', 'PaymentMethods updated.');
    }

    public function destroy(PaymentMethods $payment_method)
    {
        $payment_method->delete();
        return back()->with('success', 'PaymentMethods deleted.');
    }
}
