<?php

// app/Http/Controllers/FollowerController.php

namespace App\Http\Controllers;

use App\Models\Follower;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowerController extends Controller
{
    // // Follow a user
    // public function store(Request $request, $userId)
    // {
    //     if (Follower::where('user_id', $userId)->where('follower_id', Auth::id())->exists()) {
    //         return redirect()->back()->with('info', 'You are already following this user.');
    //     }

    //     $follower = new Follower();
    //     $follower->user_id = $userId;
    //     $follower->follower_id = Auth::id();
    //     $follower->save();

    //     return redirect()->back()->with('success', 'Now following the user.');
    // }

    // // Unfollow a user
    // public function destroy($userId)
    // {
    //     $follower = Follower::where('user_id', $userId)->where('follower_id', Auth::id())->first();
    //     if ($follower) {
    //         $follower->delete();
    //     }

    //     return redirect()->back()->with('success', 'Unfollowed the user.');
    // }
    public function store(Request $request, $userId)
    {
        if (Follower::where('user_id', $userId)->where('follower_id', Auth::id())->exists()) {
            return response()->json(['success' => false, 'message' => 'You are already following this user.']);
        }

        $follower = new Follower();
        $follower->user_id = $userId;
        $follower->follower_id = Auth::id();
        $follower->save();

        return response()->json(['success' => true, 'isFollowing' => true]);
    }

    public function destroy($userId)
    {
        $follower = Follower::where('user_id', $userId)->where('follower_id', Auth::id())->first();
        if ($follower) {
            $follower->delete();
        }

        return response()->json(['success' => true, 'isFollowing' => false]);
    }

    // Toggle follow/unfollow
    public function toggle(Request $request, $userId)
    {
        $userId = (int) $userId; // Ensure the userId is an integer

        if ($userId === Auth::id()) {
            return response()->json(['error' => 'Cannot follow yourself.'], 400);
        }

        $follower = Follower::where('user_id', $userId)->where('follower_id', Auth::id())->first();

        if ($follower) {
            // If already following, unfollow
            $follower->delete();
            return response()->json(['status' => 'unfollowed']);
        } else {
            // If not following, follow
            $follower = new Follower();
            $follower->user_id = $userId;
            $follower->follower_id = Auth::id();
            $follower->save();
            return response()->json(['status' => 'followed']);
        }
    }
}
