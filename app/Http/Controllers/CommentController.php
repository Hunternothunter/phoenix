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
    public function store(Request $request)
    {
        $validated = $request->validate([
            'post_id' => 'required|exists:posts,id',
            'content' => 'required|string|max:255',
        ]);

        $comment = new Comment();
        $comment->post_id = $validated['post_id'];
        $comment->user_id = Auth::id();
        $comment->content = $validated['content'];
        $comment->save();

        return response()->json([
            'comment' => $comment,
            'user' => $comment->user,
        ]);

        // return redirect()->route('home', $validated['post_id'])->with('success', 'Comment added successfully.');
    }

    // Delete a specific comment
    public function destroy(Comment $comment)
    {
        $comment->delete();
        return redirect()->route('posts.show', $comment->post_id)->with('success', 'Comment deleted successfully.');
    }
}
