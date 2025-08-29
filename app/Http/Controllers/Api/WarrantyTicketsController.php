<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\WarrantyTickets;
use Illuminate\Http\Request;

class WarrantyTicketsController extends Controller
{
    public function index()
    {
        return response()->json(WarrantyTickets::paginate(15));
    }

    public function store(Request $request)
    {
        $item = WarrantyTickets::create($request->all());
        return response()->json($item, 201);
    }

    public function show(WarrantyTickets $warranty_ticket)
    {
        return response()->json($warranty_ticket);
    }

    public function update(Request $request, WarrantyTickets $warranty_ticket)
    {
        $warranty_ticket->update($request->all());
        return response()->json($warranty_ticket);
    }

    public function destroy(WarrantyTickets $warranty_ticket)
    {
        $warranty_ticket->delete();
        return response()->json(null, 204);
    }
}
