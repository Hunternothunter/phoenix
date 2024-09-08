<?php

// app/Http/Controllers/CommentController.php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    // Store a new comment
    public function store(Request $request, Post $post)
    {
        $request->validate([
            'content' => 'required|string|max:255',
        ]);

        $comment = new Comment();
        $comment->post_id = $post->id;
        $comment->user_id = Auth::id();
        $comment->content = $request->input('content');
        $comment->save();

        return redirect()->route('posts.show', $post->id)->with('success', 'Comment added successfully.');
    }

    // Delete a specific comment
    public function destroy(Comment $comment)
    {
        $comment->delete();
        return redirect()->route('posts.show', $comment->post_id)->with('success', 'Comment deleted successfully.');
    }
}
