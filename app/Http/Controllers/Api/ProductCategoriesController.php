<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ProductCategories;
use Illuminate\Http\Request;

class ProductCategoriesController extends Controller
{
    public function index()
    {
        return response()->json(ProductCategories::paginate(15));
    }

    public function store(Request $request)
    {
        $item = ProductCategories::create($request->all());
        return response()->json($item, 201);
    }

    public function show(ProductCategories $product_categorie)
    {
        return response()->json($product_categorie);
    }

    public function update(Request $request, ProductCategories $product_categorie)
    {
        $product_categorie->update($request->all());
        return response()->json($product_categorie);
    }

    public function destroy(ProductCategories $product_categorie)
    {
        $product_categorie->delete();
        return response()->json(null, 204);
    }
}
