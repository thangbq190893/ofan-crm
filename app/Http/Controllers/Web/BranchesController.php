<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Branches;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BranchesController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','identify.branch']);
    }

    public function index()
    {
        $branchId = Auth::user()->branch_id ?? session('branch_id');
        $items = Branches::when($branchId, function($q) use($branchId) { return $q->where('branch_id', $branchId); })->paginate(15);
        return view('branches.index', compact('items'));
    }

    public function create()
    {
        return view('branches.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        if (!isset($data['branch_id'])) $data['branch_id'] = Auth::user()->branch_id ?? session('branch_id');
        Branches::create($data);
        return redirect()->route('branches.index')->with('success', 'Branches created.');
    }

    public function show(Branches $branche)
    {
        return view('branches.show', compact('branche'));
    }

    public function edit(Branches $branche)
    {
        return view('branches.edit', compact('branche'));
    }

    public function update(Request $request, Branches $branche)
    {
        $branche->update($request->all());
        return redirect()->route('branches.index')->with('success', 'Branches updated.');
    }

    public function destroy(Branches $branche)
    {
        $branche->delete();
        return back()->with('success', 'Branches deleted.');
    }
}
