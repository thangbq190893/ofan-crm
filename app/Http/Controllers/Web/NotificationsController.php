<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Notifications;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','identify.branch']);
    }

    public function index()
    {
        $branchId = Auth::user()->branch_id ?? session('branch_id');
        $items = Notifications::when($branchId, function($q) use($branchId) { return $q->where('branch_id', $branchId); })->paginate(15);
        return view('notifications.index', compact('items'));
    }

    public function create()
    {
        return view('notifications.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        if (!isset($data['branch_id'])) $data['branch_id'] = Auth::user()->branch_id ?? session('branch_id');
        Notifications::create($data);
        return redirect()->route('notifications.index')->with('success', 'Notifications created.');
    }

    public function show(Notifications $notification)
    {
        return view('notifications.show', compact('notification'));
    }

    public function edit(Notifications $notification)
    {
        return view('notifications.edit', compact('notification'));
    }

    public function update(Request $request, Notifications $notification)
    {
        $notification->update($request->all());
        return redirect()->route('notifications.index')->with('success', 'Notifications updated.');
    }

    public function destroy(Notifications $notification)
    {
        $notification->delete();
        return back()->with('success', 'Notifications deleted.');
    }
}
