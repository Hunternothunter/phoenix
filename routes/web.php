<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\MessageController;
use Illuminate\Support\Facades\Route;
// use App\Models\User;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/dashboard', function () {
    $user = Auth::user(); // Get the currently authenticated user
    $posts = Post::with('user')->latest()->get(); // Fetch posts
    $following = $user->following; // Fetch users the current user is following

    // Fetch activities if you have an Activity model or adjust according to your implementation
    $activities = []; // You might need to implement logic to get activities

    return view('dashboard', compact('posts', 'user', 'following', 'activities'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('posts', PostController::class);
// Route::get('/posts', [PostController::class, 'index'])->name('posts.index');

Route::resource('comments', CommentController::class)->only(['store', 'destroy']);
Route::post('posts/{post}/like', [LikeController::class, 'store'])->name('posts.like');
Route::delete('posts/{post}/like', [LikeController::class, 'destroy'])->name('posts.unlike');
Route::post('users/{userId}/follow', [FollowerController::class, 'store'])->name('users.follow');
Route::delete('users/{userId}/follow', [FollowerController::class, 'destroy'])->name('users.unfollow');
Route::resource('messages', MessageController::class)->only(['index', 'create', 'store', 'show']);
Route::post('messages/{message}/mark-as-read', [MessageController::class, 'markAsRead'])->name('messages.markAsRead');


require __DIR__ . '/auth.php';
