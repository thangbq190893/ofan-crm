<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MaintenanceJobs;
use Illuminate\Http\Request;

class MaintenanceJobsController extends Controller
{
    public function index()
    {
        return response()->json(MaintenanceJobs::paginate(15));
    }

    public function store(Request $request)
    {
        $item = MaintenanceJobs::create($request->all());
        return response()->json($item, 201);
    }

    public function show(MaintenanceJobs $maintenance_job)
    {
        return response()->json($maintenance_job);
    }

    public function update(Request $request, MaintenanceJobs $maintenance_job)
    {
        $maintenance_job->update($request->all());
        return response()->json($maintenance_job);
    }

    public function destroy(MaintenanceJobs $maintenance_job)
    {
        $maintenance_job->delete();
        return response()->json(null, 204);
    }
}
