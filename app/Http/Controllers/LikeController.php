<?php

// app/Http/Controllers/LikeController.php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    // Like a post
    public function store(Post $post)
    {
        $userId = Auth::id();
        $like = Like::where('post_id', $post->id)->where('user_id', $userId)->first();

        if ($like) {
            // If the user already liked the post, remove the like
            $like->delete();
            return redirect()->route('home')->with('success', 'Post unliked successfully.');
        } else {
            // If the user has not liked the post, add a new like
            $like = new Like();
            $like->post_id = $post->id;
            $like->user_id = $userId;
            $like->save();
            return redirect()->route('home')->with('success', 'Post liked successfully.');
        }
    }

    // Unlike a post
    public function destroy(Post $post)
    {
        $like = Like::where('post_id', $post->id)->where('user_id', Auth::id())->first();
        if ($like) {
            $like->delete();
        }

        return redirect()->route('posts.show', $post->id)->with('success', 'Post unliked successfully.');
    }
}
