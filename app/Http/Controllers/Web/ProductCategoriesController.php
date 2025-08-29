<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\ProductCategories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductCategoriesController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','identify.branch']);
    }

    public function index()
    {
        $branchId = Auth::user()->branch_id ?? session('branch_id');
        $items = ProductCategories::when($branchId, function($q) use($branchId) { return $q->where('branch_id', $branchId); })->paginate(15);
        return view('product_categories.index', compact('items'));
    }

    public function create()
    {
        return view('product_categories.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        if (!isset($data['branch_id'])) $data['branch_id'] = Auth::user()->branch_id ?? session('branch_id');
        ProductCategories::create($data);
        return redirect()->route('product_categories.index')->with('success', 'ProductCategories created.');
    }

    public function show(ProductCategories $product_categorie)
    {
        return view('product_categories.show', compact('product_categorie'));
    }

    public function edit(ProductCategories $product_categorie)
    {
        return view('product_categories.edit', compact('product_categorie'));
    }

    public function update(Request $request, ProductCategories $product_categorie)
    {
        $product_categorie->update($request->all());
        return redirect()->route('product_categories.index')->with('success', 'ProductCategories updated.');
    }

    public function destroy(ProductCategories $product_categorie)
    {
        $product_categorie->delete();
        return back()->with('success', 'ProductCategories deleted.');
    }
}
