<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Roles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RolesController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','identify.branch']);
    }

    public function index()
    {
        $branchId = Auth::user()->branch_id ?? session('branch_id');
        $items = Roles::when($branchId, function($q) use($branchId) { return $q->where('branch_id', $branchId); })->paginate(15);
        return view('roles.index', compact('items'));
    }

    public function create()
    {
        return view('roles.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        if (!isset($data['branch_id'])) $data['branch_id'] = Auth::user()->branch_id ?? session('branch_id');
        Roles::create($data);
        return redirect()->route('roles.index')->with('success', 'Roles created.');
    }

    public function show(Roles $role)
    {
        return view('roles.show', compact('role'));
    }

    public function edit(Roles $role)
    {
        return view('roles.edit', compact('role'));
    }

    public function update(Request $request, Roles $role)
    {
        $role->update($request->all());
        return redirect()->route('roles.index')->with('success', 'Roles updated.');
    }

    public function destroy(Roles $role)
    {
        $role->delete();
        return back()->with('success', 'Roles deleted.');
    }
}
