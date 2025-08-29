<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','identify.branch']);
    }

    public function index()
    {
        $branchId = Auth::user()->branch_id ?? session('branch_id');
        $items = Users::when($branchId, function($q) use($branchId) { return $q->where('branch_id', $branchId); })->paginate(15);
        return view('users.index', compact('items'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        if (!isset($data['branch_id'])) $data['branch_id'] = Auth::user()->branch_id ?? session('branch_id');
        Users::create($data);
        return redirect()->route('users.index')->with('success', 'Users created.');
    }

    public function show(Users $user)
    {
        return view('users.show', compact('user'));
    }

    public function edit(Users $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, Users $user)
    {
        $user->update($request->all());
        return redirect()->route('users.index')->with('success', 'Users updated.');
    }

    public function destroy(Users $user)
    {
        $user->delete();
        return back()->with('success', 'Users deleted.');
    }
}
