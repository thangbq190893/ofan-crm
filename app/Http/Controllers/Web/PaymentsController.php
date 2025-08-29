<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Payments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','identify.branch']);
    }

    public function index()
    {
        $branchId = Auth::user()->branch_id ?? session('branch_id');
        $items = Payments::when($branchId, function($q) use($branchId) { return $q->where('branch_id', $branchId); })->paginate(15);
        return view('payments.index', compact('items'));
    }

    public function create()
    {
        return view('payments.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        if (!isset($data['branch_id'])) $data['branch_id'] = Auth::user()->branch_id ?? session('branch_id');
        Payments::create($data);
        return redirect()->route('payments.index')->with('success', 'Payments created.');
    }

    public function show(Payments $payment)
    {
        return view('payments.show', compact('payment'));
    }

    public function edit(Payments $payment)
    {
        return view('payments.edit', compact('payment'));
    }

    public function update(Request $request, Payments $payment)
    {
        $payment->update($request->all());
        return redirect()->route('payments.index')->with('success', 'Payments updated.');
    }

    public function destroy(Payments $payment)
    {
        $payment->delete();
        return back()->with('success', 'Payments deleted.');
    }
}
