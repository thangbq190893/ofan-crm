<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Invoices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InvoicesController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','identify.branch']);
    }

    public function index()
    {
        $branchId = Auth::user()->branch_id ?? session('branch_id');
        $items = Invoices::when($branchId, function($q) use($branchId) { return $q->where('branch_id', $branchId); })->paginate(15);
        return view('invoices.index', compact('items'));
    }

    public function create()
    {
        return view('invoices.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        if (!isset($data['branch_id'])) $data['branch_id'] = Auth::user()->branch_id ?? session('branch_id');
        Invoices::create($data);
        return redirect()->route('invoices.index')->with('success', 'Invoices created.');
    }

    public function show(Invoices $invoice)
    {
        return view('invoices.show', compact('invoice'));
    }

    public function edit(Invoices $invoice)
    {
        return view('invoices.edit', compact('invoice'));
    }

    public function update(Request $request, Invoices $invoice)
    {
        $invoice->update($request->all());
        return redirect()->route('invoices.index')->with('success', 'Invoices updated.');
    }

    public function destroy(Invoices $invoice)
    {
        $invoice->delete();
        return back()->with('success', 'Invoices deleted.');
    }
}
