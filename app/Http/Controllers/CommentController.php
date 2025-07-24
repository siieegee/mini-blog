<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $request->validate([
            'body' => 'required|string|max:1000',
        ]);

        // Create the comment
        $post->comments()->create([
            'user_id' => Auth::check() ? Auth::id() : null,
            'body' => $request->body,
        ]);

        return redirect()->back()->with('success', 'Comment added.');
    }
}
