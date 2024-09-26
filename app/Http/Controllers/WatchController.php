<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WatchController extends Controller
{
    public function index()
    {
        // Fetch all posts
        $allPosts = Post::all(); // Get all posts

        // Filter for videos only
        $videos = $allPosts->filter(function ($post) {
            return preg_match('/\.(mp4|avi|mov|mkv)$/i', $post->post_media); // Adjust extensions as necessary
        });

        return view('watch.index', compact('videos')); // Pass the filtered videos to the view
    }

    public function show($id)
    {
        $video = Video::findOrFail($id); // Fetch the specific video

        return view('watch.show', compact('video'));
    }
}
