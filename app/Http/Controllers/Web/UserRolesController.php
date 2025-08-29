<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\UserRoles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserRolesController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','identify.branch']);
    }

    public function index()
    {
        $branchId = Auth::user()->branch_id ?? session('branch_id');
        $items = UserRoles::when($branchId, function($q) use($branchId) { return $q->where('branch_id', $branchId); })->paginate(15);
        return view('user_roles.index', compact('items'));
    }

    public function create()
    {
        return view('user_roles.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        if (!isset($data['branch_id'])) $data['branch_id'] = Auth::user()->branch_id ?? session('branch_id');
        UserRoles::create($data);
        return redirect()->route('user_roles.index')->with('success', 'UserRoles created.');
    }

    public function show(UserRoles $user_role)
    {
        return view('user_roles.show', compact('user_role'));
    }

    public function edit(UserRoles $user_role)
    {
        return view('user_roles.edit', compact('user_role'));
    }

    public function update(Request $request, UserRoles $user_role)
    {
        $user_role->update($request->all());
        return redirect()->route('user_roles.index')->with('success', 'UserRoles updated.');
    }

    public function destroy(UserRoles $user_role)
    {
        $user_role->delete();
        return back()->with('success', 'UserRoles deleted.');
    }
}
