<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\ReturnItems;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReturnItemsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','identify.branch']);
    }

    public function index()
    {
        $branchId = Auth::user()->branch_id ?? session('branch_id');
        $items = ReturnItems::when($branchId, function($q) use($branchId) { return $q->where('branch_id', $branchId); })->paginate(15);
        return view('return_items.index', compact('items'));
    }

    public function create()
    {
        return view('return_items.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        if (!isset($data['branch_id'])) $data['branch_id'] = Auth::user()->branch_id ?? session('branch_id');
        ReturnItems::create($data);
        return redirect()->route('return_items.index')->with('success', 'ReturnItems created.');
    }

    public function show(ReturnItems $return_item)
    {
        return view('return_items.show', compact('return_item'));
    }

    public function edit(ReturnItems $return_item)
    {
        return view('return_items.edit', compact('return_item'));
    }

    public function update(Request $request, ReturnItems $return_item)
    {
        $return_item->update($request->all());
        return redirect()->route('return_items.index')->with('success', 'ReturnItems updated.');
    }

    public function destroy(ReturnItems $return_item)
    {
        $return_item->delete();
        return back()->with('success', 'ReturnItems deleted.');
    }
}
