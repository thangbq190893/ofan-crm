<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Logs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','identify.branch']);
    }

    public function index()
    {
        $branchId = Auth::user()->branch_id ?? session('branch_id');
        $items = Logs::when($branchId, function($q) use($branchId) { return $q->where('branch_id', $branchId); })->paginate(15);
        return view('logs.index', compact('items'));
    }

    public function create()
    {
        return view('logs.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        if (!isset($data['branch_id'])) $data['branch_id'] = Auth::user()->branch_id ?? session('branch_id');
        Logs::create($data);
        return redirect()->route('logs.index')->with('success', 'Logs created.');
    }

    public function show(Logs $log)
    {
        return view('logs.show', compact('log'));
    }

    public function edit(Logs $log)
    {
        return view('logs.edit', compact('log'));
    }

    public function update(Request $request, Logs $log)
    {
        $log->update($request->all());
        return redirect()->route('logs.index')->with('success', 'Logs updated.');
    }

    public function destroy(Logs $log)
    {
        $log->delete();
        return back()->with('success', 'Logs deleted.');
    }
}
