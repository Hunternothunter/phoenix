<x-app-layout>
    <div class="container">
        <div class="d-flex img-fluid">
            @if ($post->post_media)
                @if (in_array(pathinfo($post->post_media, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif']))
                    <img src="{{ asset('storage/' . $post->post_media) }}" alt="Post Image" class="img-fluid">
                @elseif (in_array(pathinfo($post->post_media, PATHINFO_EXTENSION), ['mp4', 'mov', 'avi']))
                    <video class="img-fluid pe-1" width="420" height="240" controls>
                        <source src="{{ asset('storage/' . $post->post_media) }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                @endif
            @endif
        </div>
        <div class="d-flex flex-column align-items-center">
            <h1>{{ $post->user->firstname }}'s Post</h1>
            <p>{{ $post->content }}</p>

            <div class="d-flex flex-column">
                <h3>Comments</h3>
                <div class="card mb-2">
                    <div class="card-body">
                        @foreach ($post->comments as $comment)
                            <div class="d-flex justify-content-start align-items-start gap-3 mb-4">
                                <img src="{{ asset('storage/' . $post->user->profile_picture) }}" class="rounded-circle"
                                    width="35" height="35">
                                <div class="d-flex flex-column">
                                    <h5 class="card-title">{{ $comment->user->username }}</h5>
                                    <p class="card-text">{{ $comment->content }}</p>
                                    <span>{{ customTimeDiff($comment->post->created_at) }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

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
