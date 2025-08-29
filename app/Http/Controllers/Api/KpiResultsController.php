<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\KpiResults;
use Illuminate\Http\Request;

class KpiResultsController extends Controller
{
    public function index()
    {
        return response()->json(KpiResults::paginate(15));
    }

    public function store(Request $request)
    {
        $item = KpiResults::create($request->all());
        return response()->json($item, 201);
    }

    public function show(KpiResults $kpi_result)
    {
        return response()->json($kpi_result);
    }

    public function update(Request $request, KpiResults $kpi_result)
    {
        $kpi_result->update($request->all());
        return response()->json($kpi_result);
    }

    public function destroy(KpiResults $kpi_result)
    {
        $kpi_result->delete();
        return response()->json(null, 204);
    }
}
