<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\KpiDefinitions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KpiDefinitionsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','identify.branch']);
    }

    public function index()
    {
        $branchId = Auth::user()->branch_id ?? session('branch_id');
        $items = KpiDefinitions::when($branchId, function($q) use($branchId) { return $q->where('branch_id', $branchId); })->paginate(15);
        return view('kpi_definitions.index', compact('items'));
    }

    public function create()
    {
        return view('kpi_definitions.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        if (!isset($data['branch_id'])) $data['branch_id'] = Auth::user()->branch_id ?? session('branch_id');
        KpiDefinitions::create($data);
        return redirect()->route('kpi_definitions.index')->with('success', 'KpiDefinitions created.');
    }

    public function show(KpiDefinitions $kpi_definition)
    {
        return view('kpi_definitions.show', compact('kpi_definition'));
    }

    public function edit(KpiDefinitions $kpi_definition)
    {
        return view('kpi_definitions.edit', compact('kpi_definition'));
    }

    public function update(Request $request, KpiDefinitions $kpi_definition)
    {
        $kpi_definition->update($request->all());
        return redirect()->route('kpi_definitions.index')->with('success', 'KpiDefinitions updated.');
    }

    public function destroy(KpiDefinitions $kpi_definition)
    {
        $kpi_definition->delete();
        return back()->with('success', 'KpiDefinitions deleted.');
    }
}
