<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\\Models\\LogEntry as LogEntryModel;

class LogEntryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $items = LogEntryModel::query()->latest()->paginate(15);
        return view('logs.index', compact('items'));
    }

    public function create()
    {
        return view('logs.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $item = LogEntryModel::create($data);

        return redirect()->route('logs.show', $item->id)
            ->with('success', 'LogEntry created successfully.');
    }

    public function show(LogEntryModel $logEntry)
    {
        return view('logs.show', compact('logEntry'));
    }

    public function edit(LogEntryModel $logEntry)
    {
        return view('logs.edit', compact('logEntry'));
    }

    public function update(Request $request, LogEntryModel $logEntry)
    {
        $data = $request->all();
        $logEntry->update($data);

        return redirect()->route('logs.show', $logEntry->id)
            ->with('success', 'LogEntry updated successfully.');
    }

    public function destroy(LogEntryModel $logEntry)
    {
        $logEntry->delete();
        return redirect()->route('logs.index')
            ->with('success', 'LogEntry deleted successfully.');
    }
}
