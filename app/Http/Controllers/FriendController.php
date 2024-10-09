<?php

namespace App\Http\Controllers;

use App\Models\Friend;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FriendController extends Controller
{
    public function sendRequest($friend_id)
    {
        $friendRequest = Friend::create([
            'user_id' => Auth::id(),
            'friend_id' => $friend_id,
        ]);

        return back()->with('success', 'Friend request sent.');
    }

    public function acceptRequest($friend_id)
    {
        $friendRequest = Friend::where('user_id', $friend_id)
                               ->where('friend_id', Auth::id())
                               ->first();

        if ($friendRequest) {
            $friendRequest->update(['status' => 'accepted']);
            return back()->with('success', 'Friend request accepted.');
        }

        return back()->with('error', 'Friend request not found.');
    }

    public function removeFriend($friend_id)
    {
        $friendship = Friend::where(function ($query) use ($friend_id) {
            $query->where('user_id', Auth::id())
                  ->where('friend_id', $friend_id);
        })->orWhere(function ($query) use ($friend_id) {
            $query->where('user_id', $friend_id)
                  ->where('friend_id', Auth::id());
        })->first();

        if ($friendship) {
            $friendship->delete();
            return back()->with('success', 'Friend removed.');
        }

        return back()->with('error', 'Friend not found.');
    }
}

