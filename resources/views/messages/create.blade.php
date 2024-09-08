@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Send a New Message</h1>
        <form action="{{ route('messages.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="receiver_id">Receiver</label>
                <select id="receiver_id" name="receiver_id" class="form-control" required>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="message">Message</label>
                <textarea id="message" name="message" class="form-control" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Send Message</button>
        </form>
    </div>
@endsection
