<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Permissions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PermissionsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','identify.branch']);
    }

    public function index()
    {
        $branchId = Auth::user()->branch_id ?? session('branch_id');
        $items = Permissions::when($branchId, function($q) use($branchId) { return $q->where('branch_id', $branchId); })->paginate(15);
        return view('permissions.index', compact('items'));
    }

    public function create()
    {
        return view('permissions.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        if (!isset($data['branch_id'])) $data['branch_id'] = Auth::user()->branch_id ?? session('branch_id');
        Permissions::create($data);
        return redirect()->route('permissions.index')->with('success', 'Permissions created.');
    }

    public function show(Permissions $permission)
    {
        return view('permissions.show', compact('permission'));
    }

    public function edit(Permissions $permission)
    {
        return view('permissions.edit', compact('permission'));
    }

    public function update(Request $request, Permissions $permission)
    {
        $permission->update($request->all());
        return redirect()->route('permissions.index')->with('success', 'Permissions updated.');
    }

    public function destroy(Permissions $permission)
    {
        $permission->delete();
        return back()->with('success', 'Permissions deleted.');
    }
}
