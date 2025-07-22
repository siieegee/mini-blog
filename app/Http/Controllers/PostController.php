<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

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

    public function show(Post $post)
    {
        $post->load('user');

        $imageSrc = null;

        if ($post->photo_path) {
            $imageSrc = Str::startsWith($post->photo_path, ['http://', 'https://'])
                ? $post->photo_path
                : (Storage::disk('public')->exists($post->photo_path)
                    ? Storage::url($post->photo_path)
                    : null);
        }

        $bgImage = $imageSrc ?? 'https://images5.alphacoders.com/137/thumb-1920-1374565.png';

        return view('posts.show', compact('post', 'imageSrc', 'bgImage'));
    }


    public function edit(Post $post)
    {
        $this->authorizePostOwner($post);

        $imageSrc = null;

        if ($post->photo_path) {
            $imageSrc = Str::startsWith($post->photo_path, ['http://', 'https://'])
                ? $post->photo_path
                : (Storage::disk('public')->exists($post->photo_path)
                    ? Storage::url($post->photo_path)
                    : null);
        }

        $bgImage = $imageSrc ?? 'https://images5.alphacoders.com/137/thumb-1920-1374565.png';

        return view('posts.edit', compact('post', 'imageSrc', 'bgImage'));
    }

    public function update(Request $request, Post $post)
    {
        $this->authorizePostOwner($post);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'photo' => 'nullable|image|max:2048',
            'photo_url' => 'nullable|url',
        ]);

        if ($request->hasFile('photo')) {
            // Save new uploaded file
            $photoPath = $request->file('photo')->store('post_photos', 'public');
            $post->photo_path = $photoPath;
        } elseif ($request->filled('photo_url')) {
            // Save new URL
            $post->photo_path = $request->input('photo_url');
        }

        $post->title = $validated['title'];
        $post->content = $validated['content'];
        $post->save();

        return redirect()->route('posts.show', $post)->with('success', 'Post updated!');
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
