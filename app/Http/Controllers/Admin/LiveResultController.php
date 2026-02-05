<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LiveResult;
use Illuminate\Http\Request;

class LiveResultController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->get('status', 'all');

        $query = LiveResult::with('user')->orderBy('created_at', 'desc');

        if ($status !== 'all') {
            $query->where('status', $status);
        }

        $liveResults = $query->paginate(20);
        
        return view('admin.pages.live-results.index', compact('liveResults', 'status'));
    }

    public function create()
    {
        $users = \App\Models\User::orderBy('name')->get();
        return view('admin.pages.live-results.create', compact('users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'nullable|exists:users,id',
            'custom_name' => 'required_without:user_id|nullable|string|max:255',
            'message' => 'required|string|min:5|max:1000',
            'amount' => 'nullable|numeric|min:0',
            'status' => 'required|in:pending,approved,rejected',
            'is_featured' => 'boolean',
        ]);

        LiveResult::create($validated);

        return redirect()->route('admin.live-results.index')
            ->with('success', 'Live result created successfully.');
    }

    public function approve($id)
    {
        $result = LiveResult::findOrFail($id);
        $result->update(['status' => 'approved']);

        return redirect()->back()->with('success', 'Message approved successfully.');
    }

    public function reject($id)
    {
        $result = LiveResult::findOrFail($id);
        $result->update(['status' => 'rejected']);

        return redirect()->back()->with('success', 'Message rejected successfully.');
    }

    public function show($id)
    {
        $result = LiveResult::with('user')->findOrFail($id);
        return view('admin.pages.live-results.show', compact('result'));
    }

    public function destroy($id)
    {
        $result = LiveResult::findOrFail($id);
        $result->delete();

        return redirect()->back()->with('success', 'Message deleted successfully.');
    }
}
