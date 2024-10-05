<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Message;

class UserConversationMiddleware
{
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            // Fetch users
            $users = User::all(); // Adjust as necessary

            $currentUserId = Auth::id();
            $messages = Message::where(function ($query) use ($currentUserId) {
                $query->where('sender_id', $currentUserId)
                      ->orWhere('receiver_id', $currentUserId);
            })
            ->orderBy('created_at')
            ->get()
            ->groupBy('receiver_id'); // Group by receiver_id for easier access

            // Share data with all views
            view()->share('users', $users);
            view()->share('messages', $messages);
        }

        return $next($request);
    }
}
