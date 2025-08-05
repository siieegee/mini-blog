<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Post;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    // Make sure all routes using this controller require admin + auth
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    public function index()
    {
        $userCount = User::count();
        $postCount = Post::count();
        $pendingReports = Report::where('status', 'pending')->count();

        $recentPosts = Post::whereHas('reports')
                        ->with('user')
                        ->latest()
                        ->take(5)
                        ->get();

        return view('admin.dashboard', compact('userCount', 'postCount', 'pendingReports', 'recentPosts'));
    }

    // ================================
    // User Management
    // ================================

    // Display all users for admin
    public function users()
    {
        $users = User::all();
        $userCount = $users->count();
        $postCount = Post::count();
        $pendingReports = 0;

        return view('admin.users', compact('users', 'userCount', 'postCount', 'pendingReports'));
    }

    // Show the form for editing a specific user
    public function editUser($id)
    {
        $user = User::with('posts')->findOrFail($id);

        return view('admin.users.edit', compact('user'));
    }

    // Update a user
    public function updateUser(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $user->name = $validated['name'];
        $user->email = $validated['email'];

        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        return redirect()->route('admin.users.edit', $user->id)->with('success', 'User updated successfully.');
    }



    // Confirm delete user
    public function confirmDeleteUser($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.confirm-delete', compact('user'));
    }

    // Delete a user
    public function destroyUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.users')->with('success', 'User deleted successfully.');
    }

    // ================================
    // Post Management
    // ================================

    // Display all posts for admin
    public function posts()
    {
        $posts = Post::with('user')->latest()->get();
        $postCount = $posts->count();

        return view('admin.posts', compact('posts', 'postCount'));
    }

    // Show the form for editing a specific post
    public function editPost(Post $post)
    {
        return view('admin.posts.edit', compact('post'));
    }

    // Update a post
    public function updatePost(Request $request, $id)
    {
        $post = Post::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'photo' => 'nullable|image|max:2048',
            'photo_url' => 'nullable|url',
        ]);

        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('post_photos', 'public');
            $post->photo_path = $photoPath;
        } elseif ($request->filled('photo_url')) {
            $post->photo_path = $request->input('photo_url');
        }

        $post->title = $validated['title'];
        $post->content = $validated['content'];
        $post->save();

        return redirect()->route('admin.posts')->with('success', 'Post updated successfully.');
    }

    public function destroyPost($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        return redirect()->route('admin.posts')->with('success', 'Post deleted successfully.');
    }

    public function confirmDelete(Post $post)
    {
        return view('admin.posts.delete', compact('post'));
    }
}
