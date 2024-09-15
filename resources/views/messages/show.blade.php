<x-app-layout>
    <div class="container">
        <h1>Message Details</h1>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">From: {{ $message->sender->name }}</h5>
                <h5 class="card-title">To: {{ $message->receiver->name }}</h5>
                <p class="card-text">{{ $message->message }}</p>
                @if (!$message->is_read)
                    <form action="{{ route('messages.markAsRead', $message->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-success">Mark as Read</button>
                    </form>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
