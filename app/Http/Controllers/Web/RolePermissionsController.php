<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\RolePermissions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RolePermissionsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','identify.branch']);
    }

    public function index()
    {
        $branchId = Auth::user()->branch_id ?? session('branch_id');
        $items = RolePermissions::when($branchId, function($q) use($branchId) { return $q->where('branch_id', $branchId); })->paginate(15);
        return view('role_permissions.index', compact('items'));
    }

    public function create()
    {
        return view('role_permissions.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        if (!isset($data['branch_id'])) $data['branch_id'] = Auth::user()->branch_id ?? session('branch_id');
        RolePermissions::create($data);
        return redirect()->route('role_permissions.index')->with('success', 'RolePermissions created.');
    }

    public function show(RolePermissions $role_permission)
    {
        return view('role_permissions.show', compact('role_permission'));
    }

    public function edit(RolePermissions $role_permission)
    {
        return view('role_permissions.edit', compact('role_permission'));
    }

    public function update(Request $request, RolePermissions $role_permission)
    {
        $role_permission->update($request->all());
        return redirect()->route('role_permissions.index')->with('success', 'RolePermissions updated.');
    }

    public function destroy(RolePermissions $role_permission)
    {
        $role_permission->delete();
        return back()->with('success', 'RolePermissions deleted.');
    }
}
