<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;

use Illuminate\Routing\Controller as Controller;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // Fetch all posts, latest first
        $posts = Post::latest()->get();

        // Pass posts to dashboard view
        return view('dashboard', compact('posts'));
    }


    public function feed(Request $request)
    {
        $user = Auth::user();

        if ($request->query('mine') && $user) {
            // Show only logged-in user’s posts if 'mine=1' is set and user is logged in
            $posts = Post::where('user_id', $user->id)->latest()->paginate(20);
            $filteringMine = true;
        } else {
            // Public feed - all posts
            $posts = Post::latest()->paginate(20);
            $filteringMine = false;
        }

        return view('feed', compact('posts', 'filteringMine', 'user'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'photo' => 'nullable|image|max:2048',
            'photo_url' => 'nullable|url',
        ]);

        $photoPath = null;

        if ($request->hasFile('photo')) {
            // Store the uploaded photo
            $photoPath = $request->file('photo')->store('post_photos', 'public');
        } elseif ($request->filled('photo_url')) {
            // Use the URL directly
            $photoPath = $request->input('photo_url');
        }

        Post::create([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'user_id' => Auth::id(),
            'photo_path' => $photoPath,
        ]);

        return redirect()->route('dashboard')->with('success', 'Post created!');
    }
    public function create()
    {
        return view('posts.create');
    }

    // Show a specific post
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }


    public function edit(Post $post)
    {
        $this->authorizePostOwner($post);
        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $this->authorizePostOwner($post);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $post->update($validated);

        return redirect()->route('posts.index')->with('success', 'Post updated!');
    }

    public function destroy(Post $post)
    {
        $this->authorizePostOwner($post);

        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Post deleted!');
    }

    private function authorizePostOwner(Post $post)
    {
        if ($post->user_id !== Auth::id()) {
            abort(403);
        }
    }
}
