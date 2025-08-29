<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Expenses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExpensesController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','identify.branch']);
    }

    public function index()
    {
        $branchId = Auth::user()->branch_id ?? session('branch_id');
        $items = Expenses::when($branchId, function($q) use($branchId) { return $q->where('branch_id', $branchId); })->paginate(15);
        return view('expenses.index', compact('items'));
    }

    public function create()
    {
        return view('expenses.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        if (!isset($data['branch_id'])) $data['branch_id'] = Auth::user()->branch_id ?? session('branch_id');
        Expenses::create($data);
        return redirect()->route('expenses.index')->with('success', 'Expenses created.');
    }

    public function show(Expenses $expense)
    {
        return view('expenses.show', compact('expense'));
    }

    public function edit(Expenses $expense)
    {
        return view('expenses.edit', compact('expense'));
    }

    public function update(Request $request, Expenses $expense)
    {
        $expense->update($request->all());
        return redirect()->route('expenses.index')->with('success', 'Expenses updated.');
    }

    public function destroy(Expenses $expense)
    {
        $expense->delete();
        return back()->with('success', 'Expenses deleted.');
    }
}
