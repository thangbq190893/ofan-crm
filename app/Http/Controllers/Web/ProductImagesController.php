<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\ProductImages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductImagesController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','identify.branch']);
    }

    public function index()
    {
        $branchId = Auth::user()->branch_id ?? session('branch_id');
        $items = ProductImages::when($branchId, function($q) use($branchId) { return $q->where('branch_id', $branchId); })->paginate(15);
        return view('product_images.index', compact('items'));
    }

    public function create()
    {
        return view('product_images.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        if (!isset($data['branch_id'])) $data['branch_id'] = Auth::user()->branch_id ?? session('branch_id');
        ProductImages::create($data);
        return redirect()->route('product_images.index')->with('success', 'ProductImages created.');
    }

    public function show(ProductImages $product_image)
    {
        return view('product_images.show', compact('product_image'));
    }

    public function edit(ProductImages $product_image)
    {
        return view('product_images.edit', compact('product_image'));
    }

    public function update(Request $request, ProductImages $product_image)
    {
        $product_image->update($request->all());
        return redirect()->route('product_images.index')->with('success', 'ProductImages updated.');
    }

    public function destroy(ProductImages $product_image)
    {
        $product_image->delete();
        return back()->with('success', 'ProductImages deleted.');
    }
}
