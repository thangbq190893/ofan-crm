<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ProductImages;
use Illuminate\Http\Request;

class ProductImagesController extends Controller
{
    public function index()
    {
        return response()->json(ProductImages::paginate(15));
    }

    public function store(Request $request)
    {
        $item = ProductImages::create($request->all());
        return response()->json($item, 201);
    }

    public function show(ProductImages $product_image)
    {
        return response()->json($product_image);
    }

    public function update(Request $request, ProductImages $product_image)
    {
        $product_image->update($request->all());
        return response()->json($product_image);
    }

    public function destroy(ProductImages $product_image)
    {
        $product_image->delete();
        return response()->json(null, 204);
    }
}
