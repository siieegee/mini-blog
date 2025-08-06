<?php

namespace App\Http\Controllers;
use App\Models\Report;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use Illuminate\Support\Facades\Notification;
use App\Notifications\PostHiddenNotification;

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

    public function hidePost(Post $post)
    {
        // Soft delete the post
        $post->delete();

        $post->reports()->update(['status' => 'Accepted']);

        return redirect()->route('admin.dashboard')->with('success', "The post \"{$post->title}\" was hidden.");
    }

    public function notifyAuthor(Post $post)
    {
        $user = $post->user;

        if ($user) {
            Notification::send($user, new PostHiddenNotification($post));
            
            $post->reports()->update(['status' => 'Accepted']);

            return back()->with('success', 'User has been notified.');
        }

        return back()->with('error', 'Post author not found.');
    }

    public function rejectReport(Post $post)
    {
        $post->reports()->update(['status' => 'Rejected']);

        return back()->with('success', "Reports for the post \"{$post->title}\" have been rejected.");
    }

}
