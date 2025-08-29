<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\KpiResults;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KpiResultsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','identify.branch']);
    }

    public function index()
    {
        $branchId = Auth::user()->branch_id ?? session('branch_id');
        $items = KpiResults::when($branchId, function($q) use($branchId) { return $q->where('branch_id', $branchId); })->paginate(15);
        return view('kpi_results.index', compact('items'));
    }

    public function create()
    {
        return view('kpi_results.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        if (!isset($data['branch_id'])) $data['branch_id'] = Auth::user()->branch_id ?? session('branch_id');
        KpiResults::create($data);
        return redirect()->route('kpi_results.index')->with('success', 'KpiResults created.');
    }

    public function show(KpiResults $kpi_result)
    {
        return view('kpi_results.show', compact('kpi_result'));
    }

    public function edit(KpiResults $kpi_result)
    {
        return view('kpi_results.edit', compact('kpi_result'));
    }

    public function update(Request $request, KpiResults $kpi_result)
    {
        $kpi_result->update($request->all());
        return redirect()->route('kpi_results.index')->with('success', 'KpiResults updated.');
    }

    public function destroy(KpiResults $kpi_result)
    {
        $kpi_result->delete();
        return back()->with('success', 'KpiResults deleted.');
    }
}
