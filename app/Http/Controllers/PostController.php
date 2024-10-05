<?php

// app/Http/Controllers/PostController.php

namespace App\Http\Controllers;

use App\Models\Follower;
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
        return view('posts.index', compact('posts', 'user'));
    }

    // Show a specific post
    public function show($id)
    {
        $user = Auth::user();

        // Fetch posts for the current user with their comments
        $posts = Post::with('comments')
            ->where('user_id', $user->id)
            ->latest()
            ->get();

        return view('posts.show', compact('posts'));


        // return response()->json([
        //     'id' => $post->id,
        //     'post_media' => $post->post_media ? asset('storage/' . $post->post_media) : null,
        //     'userLink' => route('profile.show', $post->user->username),
        //     'userProfile' => $post->user->profile_picture ? asset('storage/profile_pictures/' . $post->user->profile_picture) : asset('storage/profile_pictures/default-user.png'),
        //     'userName' => $post->user->username,
        //     'content' => $post->content,
        //     'comments' => $post->comments->map(function ($comment) {
        //         return [
        //             'userLink' => route('profile.show', $comment->user->username),
        //             'userProfile' => $comment->user->profile_picture ? asset('storage/profile_pictures/' . $comment->user->profile_picture) : asset('storage/profile_pictures/default-user.png'),
        //             'userName' => $comment->user->username,
        //             'content' => $comment->content,
        //         ];
        //     }),
        // ]);
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
            'content' => 'nullable|string|max:255',
            'post_media' => 'nullable|file|mimes:jpeg,png,jpg,gif,mp4,mov,avi|max:1000000',
        ]);

        $post = new Post();
        $post->user_id = Auth::id();
        $post->content = $request->input('content');

        if ($request->hasFile('post_media')) {
            // $imagePath = $request->file('image')->store('post_images', 'public');
            // $post->image = $imagePath;
            $file = $request->file('post_media');
            $filePath = $file->store('post_media', 'public');
            $post->post_media = $filePath;
        }

        $post->save();

        return redirect()->route('home')->with('success', 'Post created successfully.');
    }

    // Show the form to edit a post
    public function edit(Post $post)
    {
        // return view('posts.edit', compact('post'));
        return response()->json([
            'content' => $post->content,
            'post_media' => $post->post_media,
            'user' => [
                'username' => $post->user->username,
                'profile_picture' => $post->user->profile_picture
            ]
        ]);
    }

    // Update a specific post
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'content' => 'required|string|max:255',
            'post_media' => 'nullable|file|mimes:jpeg,png,jpg,gif,mp4,mov,avi|max:1000000',
        ]);

        $post->content = $request->input('content');

        if ($request->hasFile('post_media')) {
            $media_path = $request->file('post_media')->store('post_media', 'public');
            $post->post_media = $media_path;
        }

        $post->save();

        return redirect()->route('home')->with('success', 'Post updated successfully.');
        // return response()->json(['message' => 'Post updated successfully']);
    }

    // Delete a specific post
    public function destroy(Post $post)
    {
        $post->delete();
        // return redirect()->back();
        return redirect()->route('home')->with('success', 'Post deleted successfully.');
    }

    public function getComments(Post $post)
    {
        $comments = $post->comments->load('user'); // Ensure user relationship is loaded
        return response()->json([
            'comments' => $comments->map(function ($comment) {
                return [
                    'user' => [
                        'username' => $comment->user->username,
                        'profile_pictures' => $comment->user->profile_pictures,
                    ],
                    'content' => $comment->content,
                ];
            }),
        ]);
    }

    public function show_videos($id)
    {
        $post = Post::with(['comments.user'])->findOrFail($id);

        return view('posts.show', compact('post'));
    }
    public function show_images($id)
    {
        $post = Post::with(['comments.user'])->findOrFail($id);

        return view('posts.show', compact('post'));
    }
}
