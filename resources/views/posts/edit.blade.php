<x-app-layout>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var modalElement = document.getElementById('view-post');

            var modal = new bootstrap.Modal(modalElement);
            
            modal.show();
        });
    </script>

    <div class="container">
        <h1>Edit Post</h1>
        <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            {{-- <div class="form-group">
                <label for="content">Content</label>
                <textarea id="content" name="content" class="form-control" required>{{ $post->content }}</textarea>
            </div>
            <div class="form-group">
                <label for="image">Image (optional)</label>
                <input type="file" id="image" name="image" class="form-control">
                @if ($post->image)
                    <img src="{{ asset('storage/' . $post->image) }}" alt="Post Image" class="img-fluid mt-2">
                @endif
            </div>
            <button type="submit" class="btn btn-primary">Update Post</button> --}}
            <x-modal name="view-post" maxWidth="lg" centered="true" title="Post Details" focusable>
                <div class="container">
                    <div class="row">
                        <!-- Image Column -->
                        <div class="col-md-5 bg-light">
                            <div id="post-image-container" class="mb-3" style="max-height: 400px;">
                                <!-- Dynamically added image -->
                                @if ($post->image)
                                    <img src="{{ asset('storage/' . $post->image) }}" alt="Post Image"
                                        class="img-fluid w-100 h-100" style="object-fit: contain;">
                                @endif
                            </div>
                        </div>

                        <!-- Content Column -->
                        <div class="col-md-7">
                            <!-- User Info -->
                            <div class="mb-3 d-flex align-items-center">
                                <a id="post-user-link" href="{{ route('profile.show', $post->user->username) }}"
                                    class="fw-bold text-body fs-lg d-flex align-items-center">
                                    <img id="post-user-profile"
                                        src="{{ $post->user->profile_picture ? asset('storage/profile_pictures/' . $post->user->profile_picture) : asset('storage/profile_pictures/default-user.png') }}"
                                        width="45" height="45" class="rounded-circle me-2 border border-sm"
                                        alt="Profile Picture">
                                    <span id="post-user-name">
                                        {{ $post->user->username }}
                                        {{-- {{ $post->user->firstname }}
                                        {{ $post->user->lastname }} --}}
                                    </span>
                                </a>
                            </div>

                            <!-- Post Content -->
                            <p id="post-content">{{ $post->content }}</p>

                            <div style="max-height: 300px; overflow-y: auto;">
                                <!-- Comments Section -->
                                <h3>Comments</h3>
                                @foreach ($post->comments as $comment)
                                    <div class="card mb-2">
                                        <div class="card-body">
                                            <a href="{{ route('profile.show', $comment->user->username) }}"
                                                class="d-flex align-items-center">
                                                <img id="post-user-profile"
                                                    src="{{ $comment->user->profile_picture ? asset('storage/profile_pictures/' . $comment->user->profile_picture) : asset('storage/profile_pictures/default-user.png') }}"
                                                    width="30" height="30"
                                                    class="rounded-circle me-2 border border-sm">
                                                <h5 class="mb-0 d-inline">{{ $comment->user->username }}
                                                </h5>
                                            </a>

                                            <p class="card-text">{{ $comment->content }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Add Comment Section -->
                            @auth
                                <form id="comment-form" action="{{ route('comments.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="post_id" value="{{ $post->id }}">
                                    <div class="form-group">
                                        <label for="content">Add a Comment</label>
                                        <textarea id="content" name="content" class="form-control" rows="3" required></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary mt-2">Post Comment</button>
                                </form>
                            @endauth
                        </div>
                    </div>
                </div>
            </x-modal>
        </form>
    </div>
</x-app-layout>
