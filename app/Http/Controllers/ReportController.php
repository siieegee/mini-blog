<?php

namespace App\Http\Controllers;
use App\Models\Report;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function store(Request $request, $postId)
    {
        $request->validate([
            'reason' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Report::create([
            'post_id' => $postId,
            'user_id' => Auth::id(),
            'reason' => $request->reason,
            'description' => $request->description,
        ]);

        return back()->with('success', 'Post reported successfully.');
    }
}
