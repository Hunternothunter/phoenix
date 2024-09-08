<?php

// app/Http/Controllers/MessageController.php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    // Show all messages for the authenticated user
    public function index()
    {
        $messages = Message::where('receiver_id', Auth::id())
            ->orWhere('sender_id', Auth::id())
            ->latest()
            ->get();
        return view('messages.index', compact('messages'));
    }

    // Show a form to send a new message
    public function create()
    {
        return view('messages.create');
    }

    // Send a new message
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

        return redirect()->route('messages.index')->with('success', 'Message sent successfully.');
    }

    // Show a specific message
    public function show(Message $message)
    {
        return view('messages.show', compact('message'));
    }

    // Mark a message as read
    public function markAsRead(Message $message)
    {
        $message->is_read = true;
        $message->save();

        return redirect()->route('messages.index')->with('success', 'Message marked as read.');
    }
}
