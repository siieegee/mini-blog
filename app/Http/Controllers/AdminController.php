<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Post;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::latest()->take(5)->get();
        $postCount = Post::count();

        return view('admin.dashboard', [
            'userCount' => $users->count(),
            'postCount' => $postCount,
            'pendingReports' => 0,
            'users' => $users,
        ]);
    }

    public function users()
    {
        $users = User::all();
        $userCount = $users->count();
        $postCount = Post::count();
        $pendingReports = 0;

        return view('admin.users', compact('users', 'userCount', 'postCount', 'pendingReports'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
        ]);

        $user = User::findOrFail($id);
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->back()->with('success', 'User updated successfully.');
    }

    // Post Management

    public function posts()
    {
        $posts = Post::with('user')->latest()->get();
        $postCount = $posts->count();

        return view('admin.posts', compact('posts', 'postCount'));
    }

    // Show the form to edit a post
    public function editPost(Post $post)
    {
        return view('admin.posts.edit', compact('post'));
    }

    public function updatePost(Request $request, $id)
    {
        $post = Post::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'photo' => 'nullable|image|max:2048',
            'photo_url' => 'nullable|url',
        ]);

        // Handle photo upload or URL
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('post_photos', 'public');
            $post->photo_path = $photoPath;
        } elseif ($request->filled('photo_url')) {
            $post->photo_path = $request->input('photo_url');
        }

        // Update post fields
        $post->title = $validated['title'];
        $post->content = $validated['content'];
        $post->save();

        return redirect()->route('admin.posts')->with('success', 'Post updated successfully.');
    }

    // Delete a post
    public function destroyPost($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        return redirect()->route('admin.posts')->with('success', 'Post deleted successfully.');
    }

    // Show delete confirmation page
    public function confirmDelete(Post $post)
    {
        return view('admin.posts.delete', compact('post'));
    }
}
