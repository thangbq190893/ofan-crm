<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\\Models\\Branch as BranchModel;

class BranchController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $items = BranchModel::query()->latest()->paginate(15);
        return view('branches.index', compact('items'));
    }

    public function create()
    {
        return view('branches.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $item = BranchModel::create($data);

        return redirect()->route('branches.show', $item->id)
            ->with('success', 'Branch created successfully.');
    }

    public function show(BranchModel $branch)
    {
        return view('branches.show', compact('branch'));
    }

    public function edit(BranchModel $branch)
    {
        return view('branches.edit', compact('branch'));
    }

    public function update(Request $request, BranchModel $branch)
    {
        $data = $request->all();
        $branch->update($data);

        return redirect()->route('branches.show', $branch->id)
            ->with('success', 'Branch updated successfully.');
    }

    public function destroy(BranchModel $branch)
    {
        $branch->delete();
        return redirect()->route('branches.index')
            ->with('success', 'Branch deleted successfully.');
    }
}
