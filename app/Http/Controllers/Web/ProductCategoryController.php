<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\\Models\\ProductCategory as ProductCategoryModel;

class ProductCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $items = ProductCategoryModel::query()->latest()->paginate(15);
        return view('product_categories.index', compact('items'));
    }

    public function create()
    {
        return view('product_categories.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $item = ProductCategoryModel::create($data);

        return redirect()->route('product_categories.show', $item->id)
            ->with('success', 'ProductCategory created successfully.');
    }

    public function show(ProductCategoryModel $productCategory)
    {
        return view('product_categories.show', compact('productCategory'));
    }

    public function edit(ProductCategoryModel $productCategory)
    {
        return view('product_categories.edit', compact('productCategory'));
    }

    public function update(Request $request, ProductCategoryModel $productCategory)
    {
        $data = $request->all();
        $productCategory->update($data);

        return redirect()->route('product_categories.show', $productCategory->id)
            ->with('success', 'ProductCategory updated successfully.');
    }

    public function destroy(ProductCategoryModel $productCategory)
    {
        $productCategory->delete();
        return redirect()->route('product_categories.index')
            ->with('success', 'ProductCategory deleted successfully.');
    }
}
