<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\\Models\\ReturnModel as ReturnModelModel;

class ReturnModelController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $items = ReturnModelModel::query()->latest()->paginate(15);
        return view('returns.index', compact('items'));
    }

    public function create()
    {
        return view('returns.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $item = ReturnModelModel::create($data);

        return redirect()->route('returns.show', $item->id)
            ->with('success', 'ReturnModel created successfully.');
    }

    public function show(ReturnModelModel $returnModel)
    {
        return view('returns.show', compact('returnModel'));
    }

    public function edit(ReturnModelModel $returnModel)
    {
        return view('returns.edit', compact('returnModel'));
    }

    public function update(Request $request, ReturnModelModel $returnModel)
    {
        $data = $request->all();
        $returnModel->update($data);

        return redirect()->route('returns.show', $returnModel->id)
            ->with('success', 'ReturnModel updated successfully.');
    }

    public function destroy(ReturnModelModel $returnModel)
    {
        $returnModel->delete();
        return redirect()->route('returns.index')
            ->with('success', 'ReturnModel deleted successfully.');
    }
}
