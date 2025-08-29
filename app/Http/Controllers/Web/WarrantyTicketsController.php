<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\WarrantyTickets;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WarrantyTicketsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','identify.branch']);
    }

    public function index()
    {
        $branchId = Auth::user()->branch_id ?? session('branch_id');
        $items = WarrantyTickets::when($branchId, function($q) use($branchId) { return $q->where('branch_id', $branchId); })->paginate(15);
        return view('warranty_tickets.index', compact('items'));
    }

    public function create()
    {
        return view('warranty_tickets.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        if (!isset($data['branch_id'])) $data['branch_id'] = Auth::user()->branch_id ?? session('branch_id');
        WarrantyTickets::create($data);
        return redirect()->route('warranty_tickets.index')->with('success', 'WarrantyTickets created.');
    }

    public function show(WarrantyTickets $warranty_ticket)
    {
        return view('warranty_tickets.show', compact('warranty_ticket'));
    }

    public function edit(WarrantyTickets $warranty_ticket)
    {
        return view('warranty_tickets.edit', compact('warranty_ticket'));
    }

    public function update(Request $request, WarrantyTickets $warranty_ticket)
    {
        $warranty_ticket->update($request->all());
        return redirect()->route('warranty_tickets.index')->with('success', 'WarrantyTickets updated.');
    }

    public function destroy(WarrantyTickets $warranty_ticket)
    {
        $warranty_ticket->delete();
        return back()->with('success', 'WarrantyTickets deleted.');
    }
}
