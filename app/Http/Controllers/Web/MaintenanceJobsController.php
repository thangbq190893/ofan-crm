<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\MaintenanceJobs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MaintenanceJobsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','identify.branch']);
    }

    public function index()
    {
        $branchId = Auth::user()->branch_id ?? session('branch_id');
        $items = MaintenanceJobs::when($branchId, function($q) use($branchId) { return $q->where('branch_id', $branchId); })->paginate(15);
        return view('maintenance_jobs.index', compact('items'));
    }

    public function create()
    {
        return view('maintenance_jobs.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        if (!isset($data['branch_id'])) $data['branch_id'] = Auth::user()->branch_id ?? session('branch_id');
        MaintenanceJobs::create($data);
        return redirect()->route('maintenance_jobs.index')->with('success', 'MaintenanceJobs created.');
    }

    public function show(MaintenanceJobs $maintenance_job)
    {
        return view('maintenance_jobs.show', compact('maintenance_job'));
    }

    public function edit(MaintenanceJobs $maintenance_job)
    {
        return view('maintenance_jobs.edit', compact('maintenance_job'));
    }

    public function update(Request $request, MaintenanceJobs $maintenance_job)
    {
        $maintenance_job->update($request->all());
        return redirect()->route('maintenance_jobs.index')->with('success', 'MaintenanceJobs updated.');
    }

    public function destroy(MaintenanceJobs $maintenance_job)
    {
        $maintenance_job->delete();
        return back()->with('success', 'MaintenanceJobs deleted.');
    }
}
