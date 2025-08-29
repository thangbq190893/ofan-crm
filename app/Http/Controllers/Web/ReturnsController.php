<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Returns;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReturnsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','identify.branch']);
    }

    public function index()
    {
        $branchId = Auth::user()->branch_id ?? session('branch_id');
        $items = Returns::when($branchId, function($q) use($branchId) { return $q->where('branch_id', $branchId); })->paginate(15);
        return view('returns.index', compact('items'));
    }

    public function create()
    {
        return view('returns.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        if (!isset($data['branch_id'])) $data['branch_id'] = Auth::user()->branch_id ?? session('branch_id');
        Returns::create($data);
        return redirect()->route('returns.index')->with('success', 'Returns created.');
    }

    public function show(Returns $return)
    {
        return view('returns.show', compact('return'));
    }

    public function edit(Returns $return)
    {
        return view('returns.edit', compact('return'));
    }

    public function update(Request $request, Returns $return)
    {
        $return->update($request->all());
        return redirect()->route('returns.index')->with('success', 'Returns updated.');
    }

    public function destroy(Returns $return)
    {
        $return->delete();
        return back()->with('success', 'Returns deleted.');
    }
}
