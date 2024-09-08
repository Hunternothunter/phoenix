<?php

// app/Http/Controllers/PostController.php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    // Show a list of posts
    public function index()
    {
        // $posts = Post::with('user')->latest()->get();
        // return view('posts.index', compact('posts'));

        $posts = Post::with('user')->latest()->get();
        $user = Auth::user(); // Assuming you want to show the currently authenticated user
        return view('posts.index', compact('posts', 'user', 'activities'));
    }

    // Show a specific post
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    // Show the form to create a new post
    public function create()
    {
        return view('posts.create');
    }

    // Store a new post
    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $post = new Post();
        $post->user_id = Auth::id();
        $post->content = $request->input('content');

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $post->image = $imagePath;
        }

        $post->save();

        return redirect()->route('posts.index')->with('success', 'Post created successfully.');
    }

    // Show the form to edit a post
    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    // Update a specific post
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'content' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $post->content = $request->input('content');

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $post->image = $imagePath;
        }

        $post->save();

        return redirect()->route('posts.index')->with('success', 'Post updated successfully.');
    }

    // Delete a specific post
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('posts.index')->with('success', 'Post deleted successfully.');
    }
}
