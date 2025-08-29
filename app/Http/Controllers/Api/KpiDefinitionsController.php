<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\KpiDefinitions;
use Illuminate\Http\Request;

class KpiDefinitionsController extends Controller
{
    public function index()
    {
        return response()->json(KpiDefinitions::paginate(15));
    }

    public function store(Request $request)
    {
        $item = KpiDefinitions::create($request->all());
        return response()->json($item, 201);
    }

    public function show(KpiDefinitions $kpi_definition)
    {
        return response()->json($kpi_definition);
    }

    public function update(Request $request, KpiDefinitions $kpi_definition)
    {
        $kpi_definition->update($request->all());
        return response()->json($kpi_definition);
    }

    public function destroy(KpiDefinitions $kpi_definition)
    {
        $kpi_definition->delete();
        return response()->json(null, 204);
    }
}
