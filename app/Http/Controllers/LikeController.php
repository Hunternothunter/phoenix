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
        if (Like::where('post_id', $post->id)->where('user_id', Auth::id())->exists()) {
            return redirect()->route('posts.show', $post->id)->with('info', 'You already liked this post.');
        }

        $like = new Like();
        $like->post_id = $post->id;
        $like->user_id = Auth::id();
        $like->save();

        return redirect()->route('posts.show', $post->id)->with('success', 'Post liked successfully.');
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
