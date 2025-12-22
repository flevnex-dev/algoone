<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LiveResult;
use Illuminate\Http\Request;

class LiveResultController extends Controller
{
    public function index()
    {
        // Get only approved live results
        $liveResults = LiveResult::where('status', 'approved')
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(20);
        
        return view('admin.pages.live-results.index', compact('liveResults'));
    }
}
