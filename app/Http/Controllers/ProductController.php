<?php
namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return response()->json(Product::all());
    }
    public function store(Request $request)
    {
        $data = $request->all();
        $record = Product::create($data);
        return response()->json($record, 201);
    }
    public function show(Product $item)
    {
        return response()->json($item);
    }
    public function update(Request $request, Product $item)
    {
        $item->update($request->all());
        return response()->json($item);
    }
    public function destroy(Product $item)
    {
        $item->delete();
        return response()->json(null, 204);
    }
}
