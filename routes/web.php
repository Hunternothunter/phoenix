<?php

// use App\Http\Controllers\Auth\VerificationController;
// use App\Http\Controllers\ProfileController;
// use App\Http\Controllers\PostController;
// use App\Http\Controllers\CommentController;
// use App\Http\Controllers\LikeController;
// use App\Http\Controllers\FollowerController;
// use App\Http\Controllers\MessageController;
// use App\Http\Controllers\WatchController;
// use Illuminate\Support\Facades\Route;
// // use App\Models\User;
// use App\Models\Post;
// use Illuminate\Support\Facades\Auth;

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/home', function () {
//     $user = Auth::user();
//     $posts = Post::with('user')->latest()->get();
//     $following = $user->following;

//     $activities = [];
//     return view('home', compact('posts', 'user', 'following', 'activities'));
// })->middleware(['auth', 'verified'])->name('home');

// Route::get('/{username}', [ProfileController::class, 'show'])->name('profile.show');
// Route::get('/posts/{post}/comments', [PostController::class, 'getComments']);

// Route::middleware('auth')->group(function () {
//     Route::get('/search', [ProfileController::class, 'search'])->name('profile.search');

//     Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
//     Route::get('/profile/{id}/edit', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

//     Route::post('/posts/{post}/likes', [LikeController::class, 'store'])->name('likes.store');
// });

// Route::resource('posts', PostController::class);
// // Route::get('/posts', [PostController::class, 'index'])->name('posts.index');

// Route::post('follow/{userId}', [FollowerController::class, 'store'])->name('followers.store');
// // Route::post('/followers/toggle/{user}', [FollowerController::class, 'toggle'])->name('followers.toggle');

// Route::resource('comments', CommentController::class)->only(['store', 'destroy']);
// Route::post('posts/{post}/like', [LikeController::class, 'store'])->name('posts.like');
// Route::delete('posts/{post}/like', [LikeController::class, 'destroy'])->name('posts.unlike');

// Route::post('users/{userId}/follow', [FollowerController::class, 'store'])->name('users.follow');
// Route::delete('users/{userId}/follow', [FollowerController::class, 'destroy'])->name('users.unfollow');
// Route::post('users/{userId}/follow-toggle', [FollowerController::class, 'toggle'])->name('users.followToggle');

// Route::get('watch/index', [WatchController::class, 'index'])->name('watch.index');
// Route::post('watch/{id}/show', [WatchController::class, 'show'])->name('watch.show');

// Route::resource('messages', MessageController::class)->only(['index', 'create', 'store', 'show']);
// Route::get('messages/e2ee/t/{user}', [MessageController::class, 'create'])->name('messages.create');
// Route::get('messages/{user}', [MessageController::class, 'showConversation'])->name('messages.showConversation');

// Route::post('messages/{message}/mark-as-read', [MessageController::class, 'markAsRead'])->name('messages.markAsRead');

// Route::post('/send-otp', [VerificationController::class, 'sendOtp'])->name('send.otp');
// Route::post('/verify-otp', [VerificationController::class, 'verifyOtp'])->name('verify.otp');

// require __DIR__ . '/auth.php';

use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\WatchController;
use Illuminate\Support\Facades\Route;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

// Home route
Route::get('/', function () {
    if (Auth::check()) {
        $user = Auth::user();
        $posts = Post::with('user')->latest()->get();
        $following = $user->following;
        $activities = [];
        return view('dashboard', compact('posts', 'user', 'following', 'activities'));
    } else {
        return view('auth.login');
    }
})->name('home');


// Home route
Route::get('/dashboard', function () {
    return redirect('/');
})->middleware(['auth', 'verified']);

// Profile routes
Route::get('/{username}', [ProfileController::class, 'show'])->name('profile.show');

Route::middleware('auth')->group(function () {
    Route::get('/search', [ProfileController::class, 'search'])->name('profile.search');

    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'index'])->name('profile.index');
        Route::get('{id}/edit', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    // Post routes
    Route::resource('posts', PostController::class);
    Route::post('posts/{post}/likes', [LikeController::class, 'store'])->name('likes.store');
    Route::post('posts/{post}/like', [LikeController::class, 'store'])->name('posts.like');
    Route::delete('posts/{post}/like', [LikeController::class, 'destroy'])->name('posts.unlike');

    // Comment routes
    Route::resource('comments', CommentController::class)->only(['store', 'destroy']);

    // Follower routes
    Route::prefix('users/{userId}')->group(function () {
        Route::post('follow', [FollowerController::class, 'store'])->name('users.follow');
        Route::delete('follow', [FollowerController::class, 'destroy'])->name('users.unfollow');
        Route::post('follow-toggle', [FollowerController::class, 'toggle'])->name('users.followToggle');
    });

    // Message routes
    Route::resource('messages', MessageController::class)->only(['index', 'create', 'store', 'show']);
    Route::get('messages/e2ee/t/{user}', [MessageController::class, 'create'])->name('messages.create');
    Route::get('messages/{user}', [MessageController::class, 'showConversation'])->name('messages.showConversation');
    Route::post('messages/{message}/mark-as-read', [MessageController::class, 'markAsRead'])->name('messages.markAsRead');
});

// Watch routes
Route::prefix('watch')->group(function () {
    Route::get('index', [WatchController::class, 'index'])->name('watch.index');
    Route::post('{id}/show', [WatchController::class, 'show'])->name('watch.show');
});

// OTP verification routes
Route::post('/send-otp', [VerificationController::class, 'sendOtp'])->name('send.otp');
Route::post('/verify-otp', [VerificationController::class, 'verifyOtp'])->name('verify.otp');

// Auth routes
require __DIR__ . '/auth.php';
