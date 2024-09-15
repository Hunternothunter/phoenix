<x-app-layout>
    <div class="container">
        <h1>{{ $post->user->firstname }}'s Post</h1>
        <p>{{ $post->content }}</p>
        @if ($post->image)
            <img src="{{ asset('storage/' . $post->image) }}" alt="Post Image" class="img-fluid">
        @endif

        <h3>Comments</h3>
        @foreach ($post->comments as $comment)
            <div class="card mb-2">
                <div class="card-body">
                    <h5 class="card-title">{{ $comment->user->name }}</h5>
                    <p class="card-text">{{ $comment->content }}</p>
                </div>
            </div>
        @endforeach

        @auth
            <form action="{{ route('comments.store', $post->id) }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="content">Add a Comment</label>
                    <textarea id="content" name="content" class="form-control" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary mt-2">Post Comment</button>
            </form>
        @endauth
    </div>
</x-app-layout>
