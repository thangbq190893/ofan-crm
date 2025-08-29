<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Products;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index()
    {
        return response()->json(Products::paginate(15));
    }

    public function store(Request $request)
    {
        $item = Products::create($request->all());
        return response()->json($item, 201);
    }

    public function show(Products $product)
    {
        return response()->json($product);
    }

    public function update(Request $request, Products $product)
    {
        $product->update($request->all());
        return response()->json($product);
    }

    public function destroy(Products $product)
    {
        $product->delete();
        return response()->json(null, 204);
    }
}
