<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Invoices;
use Illuminate\Http\Request;

class InvoicesController extends Controller
{
    public function index()
    {
        return response()->json(Invoices::paginate(15));
    }

    public function store(Request $request)
    {
        $item = Invoices::create($request->all());
        return response()->json($item, 201);
    }

    public function show(Invoices $invoice)
    {
        return response()->json($invoice);
    }

    public function update(Request $request, Invoices $invoice)
    {
        $invoice->update($request->all());
        return response()->json($invoice);
    }

    public function destroy(Invoices $invoice)
    {
        $invoice->delete();
        return response()->json(null, 204);
    }
}
