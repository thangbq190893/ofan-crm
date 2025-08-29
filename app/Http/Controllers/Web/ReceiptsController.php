<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Receipts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReceiptsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','identify.branch']);
    }

    public function index()
    {
        $branchId = Auth::user()->branch_id ?? session('branch_id');
        $items = Receipts::when($branchId, function($q) use($branchId) { return $q->where('branch_id', $branchId); })->paginate(15);
        return view('receipts.index', compact('items'));
    }

    public function create()
    {
        return view('receipts.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        if (!isset($data['branch_id'])) $data['branch_id'] = Auth::user()->branch_id ?? session('branch_id');
        Receipts::create($data);
        return redirect()->route('receipts.index')->with('success', 'Receipts created.');
    }

    public function show(Receipts $receipt)
    {
        return view('receipts.show', compact('receipt'));
    }

    public function edit(Receipts $receipt)
    {
        return view('receipts.edit', compact('receipt'));
    }

    public function update(Request $request, Receipts $receipt)
    {
        $receipt->update($request->all());
        return redirect()->route('receipts.index')->with('success', 'Receipts updated.');
    }

    public function destroy(Receipts $receipt)
    {
        $receipt->delete();
        return back()->with('success', 'Receipts deleted.');
    }
}
