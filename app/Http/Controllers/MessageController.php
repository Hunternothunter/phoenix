<?php

// app/Http/Controllers/MessageController.php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    // // Show all messages for the authenticated user
    // public function index()
    // {
    //     $messages = Message::where('receiver_id', Auth::id())
    //         ->orWhere('sender_id', Auth::id())
    //         ->latest()
    //         ->get();
    //     return view('messages.index', compact('messages'));
    // }

    // // Show a form to send a new message
    // public function create()
    // {
    //     return view('messages.create');
    // }

    // // Send a new message
    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'receiver_id' => 'required|exists:users,id',
    //         'message' => 'required|string|max:255',
    //     ]);

    //     $message = new Message();
    //     $message->sender_id = Auth::id();
    //     $message->receiver_id = $request->input('receiver_id');
    //     $message->message = $request->input('message');
    //     $message->is_read = false;
    //     $message->save();

    //     return redirect()->route('messages.index')->with('success', 'Message sent successfully.');
    // }

    // // Show a specific message
    // public function show(Message $message)
    // {
    //     return view('messages.show', compact('message'));
    // }

    // // Mark a message as read
    // public function markAsRead(Message $message)
    // {
    //     $message->is_read = true;
    //     $message->save();

    //     return redirect()->route('messages.index')->with('success', 'Message marked as read.');
    // }



    public function index()
    {
        // $messages = Message::where(function ($query) {
        //     $query->where('receiver_id', Auth::id())
        //         ->orWhere('sender_id', Auth::id());
        // })
        //     ->latest()
        //     ->get();

        // return view('messages.index', compact('messages'));

        // Get the authenticated user
        $userId = Auth::id();

        // Fetch users who have messaged the authenticated user
        $users = User::whereHas('receivedMessages', function ($query) use ($userId) {
            $query->where('receiver_id', $userId);
        })->get();

        // Fetch messages for the selected user if any
        $chatUser = null;
        $messages = [];
        if (request()->has('user')) {
            $chatUserId = request()->input('user');
            $chatUser = User::findOrFail($chatUserId);
            $messages = Message::where(function ($query) use ($userId, $chatUserId) {
                $query->where('sender_id', $userId)->where('receiver_id', $chatUserId);
            })->orWhere(function ($query) use ($userId, $chatUserId) {
                $query->where('sender_id', $chatUserId)->where('receiver_id', $userId);
            })->get();
        }

        return view('messages.index', compact('users', 'messages', 'chatUser'));
    }

    public function create(User $user)
    {
        // $receiver = User::findOrFail($userId);
        // return view('messages.create', compact('receiver'));
        $messages = Message::where(function ($query) use ($user) {
            $query->where('sender_id', Auth::id())
                ->where('receiver_id', $user->id);
        })->orWhere(function ($query) use ($user) {
            $query->where('sender_id', $user->id)
                ->where('receiver_id', Auth::id());
        })->orderBy('created_at')->get();

        return view('messages.create', [
            'messages' => $messages,
            'currentUser' => Auth::user(),
            'receiver' => $user,
            'users' => User::all() // or a more filtered list of users
        ]);
        
    }


    public function store(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'message' => 'required|string|max:255',
        ]);

        $message = new Message();
        $message->sender_id = Auth::id();
        $message->receiver_id = $request->input('receiver_id');
        $message->message = $request->input('message');
        $message->is_read = false;
        $message->save();

        return redirect()->route('messages.create', $message->receiver_id)->with('success', 'Message sent successfully.');
    }

    public function show(Message $message)
    {
        return view('messages.show', compact('message'));
    }
    public function markAsRead(Message $message)
    {
        $message->is_read = true;
        $message->save();

        return redirect()->route('messages.index')->with('success', 'Message marked as read.');
    }

    public function showConversation(User $user)
    {
        $messages = Message::where(function ($query) use ($user) {
            $query->where('sender_id', Auth::id())
                ->where('receiver_id', $user->id);
        })->orWhere(function ($query) use ($user) {
            $query->where('sender_id', $user->id)
                ->where('receiver_id', Auth::id());
        })->orderBy('created_at')->get();

        return view('messages.index', [
            'messages' => $messages,
            'currentUser' => Auth::user(),
            'receiver' => $user,
            'users' => User::all() // Assuming you want to show all users in the list
        ]);
    }
}
