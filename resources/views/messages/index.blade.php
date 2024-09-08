@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Messages</h1>
        <a href="{{ route('messages.create') }}" class="btn btn-primary">New Message</a>
        <div class="list-group mt-3">
            @foreach($messages as $message)
                <a href="{{ route('messages.show', $message->id) }}" class="list-group-item list-group-item-action">
                    <h5>From: {{ $message->sender->name }} To: {{ $message->receiver->name }}</h5>
                    <p>{{ Str::limit($message->message, 50) }}</p>
                </a>
            @endforeach
        </div>
    </div>
@endsection
