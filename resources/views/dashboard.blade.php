<x-app-layout>
    <!-- Include this CSS in your stylesheet or within a <style> tag -->
    <style>
        .custom-textarea {
            border-radius: 20px;
            /* Adjust the radius to your liking */
            resize: none;
            /* Optionally disable resizing */
            padding: 10px;
            /* Optional padding */
        }

        /* Default state for the heart icon */
        .lucide-heart {
            color: gray;
            /* Default color */
            fill: none;
            /* No fill for unliked state */
        }

        /* When the post is liked */
        .liked .lucide-heart {
            color: red;
            /* Red color for liked state */
            fill: red;
            /* Fill the heart with red */
        }
    </style>

    <div class="container-fluid p-0">
        <div class="container p-0">
            <div class="row">
                <div class="col-12 col-lg-8">
                    <div class="card mb-3 rounded-4">
                        <div class="card-body">
                            <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row align-items-start">
                                    <!-- User Profile Section -->
                                    <div class="col-1 d-flex justify-content-center">
                                        <a href="{{ route('profile.show', Auth::user()->username) }}">
                                            <img src="{{ Auth::user()->profile_picture ? asset('storage/' . Auth::user()->profile_picture) : asset('storage/profile_pictures/default-user.png') }}"
                                                width="50" height="50"
                                                class="rounded-circle border border-light shadow-sm"
                                                alt="{{ Auth::user()->name }}">
                                        </a>
                                    </div>

                                    <!-- Input Field and Photo/Video Button Section -->
                                    <div class="col-11">
                                        <div class="mb-3">
                                            <button type="button"
                                                class="btn btn-light btn-lg w-100 h-100 fs-5 text-start rounded-5"
                                                data-bs-toggle="modal" data-bs-target="#whats-on-your-mind">
                                                What's on your mind, {{ Auth::user()->firstname }}?
                                            </button>
                                        </div>
                                        <hr class="my-2">

                                        @include('modals.create-post')

                                        <div class="d-flex align-items-center">
                                            <button type="button" class="btn btn-lg me-2 d-flex align-items-center"
                                                data-bs-toggle="modal" data-bs-target="#whats-on-your-mind"
                                                style="background-color: transparent; border: 1px solid transparent;"
                                                onmouseover="this.style.backgroundColor='#EBEBEB'; this.style.borderColor='#EBEBEB';"
                                                onmouseout="this.style.backgroundColor='transparent'; this.style.borderColor='transparent';">
                                                <i class="align-middle me-2" data-lucide="video"></i>
                                                <span class="align-middle fw-bold">Live video</span>
                                            </button>

                                            <div class="d-flex align-items-center">
                                                <button type="button" class="btn btn-lg me-2 d-flex align-items-center"
                                                    data-bs-toggle="modal" data-bs-target="#whats-on-your-mind"
                                                    style="background-color: transparent; border: 1px solid transparent;"
                                                    onmouseover="this.style.backgroundColor='#EBEBEB'; this.style.borderColor='#EBEBEB';"
                                                    onmouseout="this.style.backgroundColor='transparent'; this.style.borderColor='transparent';">
                                                    <i class="align-middle me-2" data-lucide="images"></i>
                                                    <span class="align-middle fw-bold">Photo/Video</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    @foreach ($posts as $post)
                        {{-- <x-modal name="view-post" maxWidth="lg" centered="true" title="Post Details" focusable>
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
                                        <div class="mb-3 d-flex align-items-center justify-content-between">
                                            <a id="post-user-link"
                                                href="{{ route('profile.show', $post->user->username) }}"
                                                class="fw-bold text-body fs-lg d-flex align-items-center">
                                                <img id="post-user-profile"
                                                    src="{{ $post->user->profile_picture ? asset('storage/profile_pictures/' . $post->user->profile_picture) : asset('storage/profile_pictures/default-user.png') }}"
                                                    width="45" height="45"
                                                    class="rounded-circle me-2 border border-sm">
                                                <span id="post-user-name">
                                                    {{ $post->user->username }}
                                                </span>
                                            </a>
                                            <a class="nav-link d-none d-sm-inline-block cursor-pointer"
                                                data-bs-toggle="dropdown" data-lucide="ellipsis-vertical">
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                @if (Auth::id() === $post->user_id)
                                                    <a class='dropdown-item btn-edit-post'
                                                        href="{{ route('posts.edit', $post->id) }}">
                                                        <i class="align-middle me-1" data-lucide="pencil"></i>
                                                        Edit Post
                                                    </a>
                                                    <form action="{{ route('posts.destroy', $post->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="dropdown-item btn-delete-post" type="submit">
                                                            <i class="align-middle me-1" data-lucide="trash-2"></i>
                                                            Delete Post
                                                        </button>
                                                    </form>
                                                @endif
                                            </div>
                                        </div>

                                        <!-- Post Content -->
                                        <p id="post-content">{{ $post->content }}</p>

                                        <div id="comments-container" style="max-height: 300px; overflow-y: auto;">
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
                                            <form id="comment-form" method="POST">
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
                        </x-modal> --}}
                        <x-modal name="view-post" maxWidth="lg" centered="true" title="Post Details" focusable>
                            <div class="container">
                                <div class="row">
                                    <!-- Image Column -->
                                    <div class="col-md-5 bg-light">
                                        <div id="post-image-container" class="mb-3" style="max-height: 400px;">
                                            <!-- Dynamically added image -->
                                            <img id="modal-post-image" class="img-fluid w-100 h-100"
                                                style="object-fit: contain;">
                                        </div>
                                    </div>

                                    <!-- Content Column -->
                                    <div class="col-md-7">
                                        <!-- User Info -->
                                        <div class="mb-3 d-flex align-items-center justify-content-between">
                                            <a id="post-user-link"
                                                class="fw-bold text-body fs-lg d-flex align-items-center">
                                                <img id="post-user-profile" width="45" height="45"
                                                    class="rounded-circle me-2 border border-sm">
                                                <span id="post-user-name"></span>
                                            </a>
                                            <!-- Dropdown Menu -->
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a class='dropdown-item btn-edit-post' id="edit-post-link">
                                                    <i class="align-middle me-1" data-lucide="pencil"></i>
                                                    Edit Post
                                                </a>
                                                <form id="delete-post-form" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="dropdown-item btn-delete-post" type="submit">
                                                        <i class="align-middle me-1" data-lucide="trash-2"></i>
                                                        Delete Post
                                                    </button>
                                                </form>
                                            </div>
                                        </div>

                                        <!-- Post Content -->
                                        <p id="post-content"></p>

                                        <div id="comments-container" style="max-height: 300px; overflow-y: auto;"></div>

                                        <!-- Add Comment Section -->
                                        @auth
                                            <form id="comment-form" method="POST">
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


                        <div class="card rounded-4 mb-3">
                            <div class="card-body h-100">
                                <div class="d-flex align-items-start">
                                    <a href="{{ route('profile.show', $post->user->username) }}">
                                        <img src="{{ $post->user->profile_picture ? asset('storage/profile_pictures/' . $post->user->profile_picture) : asset('storage/profile_pictures/default-user.png') }}"
                                            width="50" height="50"
                                            class="rounded-circle me-3 border border-sm"
                                            alt="{{ $post->user->firstname }}">
                                    </a>

                                    <div class="flex-grow-1">
                                        <div class="flex-grow-1 d-flex justify-content-between align-items-center">
                                            <a href="{{ route('profile.show', $post->user->username) }}"
                                                class="text-decoration-none text-dark">
                                                <div class="d-flex align-items-center gap-2">
                                                    <span class="fw-bold">
                                                        {{ $post->user->username }}
                                                    </span>
                                                    <span class="text-dark fw-bold">
                                                        {{ customTimeDiff($post->created_at) }}
                                                    </span>
                                                </div>
                                            </a>
                                            <a class="nav-link d-none d-sm-inline-block cursor-pointer"
                                                data-bs-toggle="dropdown" data-lucide="ellipsis-vertical">
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                @if (Auth::id() === $post->user_id)
                                                    <a class='dropdown-item btn-edit-post'
                                                        href="{{ route('posts.edit', $post->id) }}">
                                                        <i class="align-middle me-1" data-lucide="pencil"></i>
                                                        Edit Post
                                                    </a>
                                                    <form action="{{ route('posts.destroy', $post->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="dropdown-item btn-delete-post" type="submit">
                                                            <i class="align-middle me-1" data-lucide="trash-2"></i>
                                                            Delete Post
                                                        </button>
                                                    </form>
                                                @else
                                                    <a class='dropdown-item btn-archive-post' href="#">
                                                        <i class="align-middle me-1" data-lucide="archive"></i>
                                                        {{-- {{ route('posts.archive', $post->id) }} --}}
                                                        Archive Post
                                                    </a>
                                                    <a class='dropdown-item btn-save-feed' href="#">
                                                        <i class="align-middle me-1" data-lucide="save"></i>
                                                        {{-- {{ route('posts.removeFromFeed', $post->id) }} --}}
                                                        Save Post
                                                    </a>
                                                    <a class='dropdown-item btn-remove-feed' href="#">
                                                        <i class="align-middle me-1" data-lucide="remove"></i>
                                                        {{-- {{ route('posts.removeFromFeed', $post->id) }} --}}
                                                        Remove from Feed
                                                    </a>
                                                @endif
                                            </div>

                                        </div>
                                        <p>{{ $post->content }}</p>
                                        {{-- @include('modals.view-post') --}}

                                        @if ($post->image)
                                            <button type="button" class="decoration-none border-0"
                                                data-bs-toggle="modal" data-bs-target="#view-post"
                                                data-post-id="{{ $post->id }}"
                                                data-post-content="{{ $post->content }}"
                                                data-post-image="{{ asset('storage/' . $post->image) }}"
                                                data-user-link="{{ route('profile.show', $post->user->username) }}"
                                                data-user-name="{{ $post->user->username }}"
                                                data-user-profile="{{ $post->user->profile_picture ? asset('storage/profile_pictures/' . $post->user->profile_picture) : asset('storage/profile_pictures/default-user.png') }}">
                                                <img src="{{ asset('storage/' . $post->image) }}"
                                                    class="img-fluid pe-1" alt="{{ $post->content }}">
                                            </button>
                                        @endif

                                        {{-- @if ($post->image)
                                            <button type="button" class="decoration-none border-0"
                                                data-bs-toggle="modal" data-bs-target="#view-post">
                                                <img src="{{ asset('storage/' . $post->image) }}"
                                                    class="img-fluid pe-1" alt="{{ $post->content }}">
                                            </button>
                                            @php
                                                $images = $post->images;
                                            @endphp
                                            @foreach ($images as $image)
                                                <div class="col-6">
                                                    <img src="{{ asset('storage/post_images/' . $image) }}"
                                                        class="img-fluid pe-1" alt="Post Image">
                                                </div>
                                            @endforeach
                                        @endif --}}

                                        <div class="d-flex align-items-center">
                                            <!-- Like Button -->
                                            <form action="{{ route('likes.store', $post->id) }}" method="POST"
                                                class="me-3">
                                                @csrf
                                                @php
                                                    $liked = $post->likes()->where('user_id', Auth::id())->exists();
                                                    $likeCount = $post->likeCount();
                                                @endphp
                                                <button type="submit" class="btn mt-1 {{ $liked ? 'liked' : '' }}">
                                                    <i class="align-middle" data-lucide="heart"></i>
                                                    @if ($likeCount > 0)
                                                        {{ $likeCount }}
                                                    @endif
                                                </button>
                                            </form>

                                            <!-- Comment Button -->
                                            @php
                                                $commentCount = $post->comments()->count();
                                            @endphp
                                            <button type="button" class="btn mt-1" data-bs-toggle="modal"
                                                data-bs-target="#view-post">
                                                <i class="align-middle" data-lucide="message-circle"></i>
                                                @if ($commentCount > 0)
                                                    {{ $commentCount }}
                                                @endif
                                            </button>

                                            <!-- Share Button -->
                                            <form action="{{ route('likes.store', $post->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn mt-1">
                                                    <i class="align-middle" data-lucide="forward"></i>
                                                    {{-- @if ($post->shareCount() > 0)
                                                        {{ $post->shareCount() }}
                                                    @endif --}}
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Profile Section -->
                <div class="col-12 col-lg-4">
                    <div class="card mb-3">
                        <div class="card-body text-center">
                            <img src="{{ Auth::user()->profile_picture ? asset('storage/profile_pictures/' . Auth::user()->profile_picture) : asset('storage/profile_pictures/default-user.png') }}"
                                width="128" height="128" class="rounded-circle border border-light shadow-sm"
                                alt="{{ Auth::user()->firstname }}">
                            <h4 class="card-title mb-0">{{ $user->firstname . ' ' . $user->lastname }}</h4>
                            <div class="text-muted mb-2">{{ $user->email }}</div>
                            <div>
                                <a class="btn btn-primary btn-sm"
                                    href="{{ route('users.follow', $user->id) }}">Follow</a>
                                <a class="btn btn-primary btn-sm"
                                    href="{{ route('messages.create', $user->id) }}"><span
                                        data-lucide="message-square"></span> Message</a>
                            </div>
                        </div>
                    </div>

                    <!-- Following Section -->
                    <div class="card mb-3">
                        <div class="card-header">
                            <div class="card-actions float-end">
                                <div class="dropdown position-relative">
                                    <a href="#" data-bs-toggle="dropdown" data-bs-display="static">
                                        <i class="align-middle" data-lucide="more-horizontal"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a class="dropdown-item" href="#">Action</a>
                                        <a class="dropdown-item" href="#">Another action</a>
                                        <a class="dropdown-item" href="#">Something else here</a>
                                    </div>
                                </div>
                            </div>
                            <h5 class="card-title mb-0">Following</h5>
                        </div>
                        <div class="card-body">
                            @foreach ($user->following as $followedUser)
                                <div class="d-flex align-items-start">
                                    <img src="{{ asset('storage/' . $followedUser->avatar) }}" width="56"
                                        height="56" class="rounded-circle me-2" alt="{{ $followedUser->name }}">
                                    <div class="flex-grow-1">
                                        <p class="my-1"><strong>{{ $followedUser->name }}</strong></p>
                                        <a class="btn btn-sm btn-outline-primary"
                                            href="{{ route('users.unfollow', $followedUser->id) }}">Unfollow</a>
                                    </div>
                                </div>
                                <hr class="my-2" />
                            @endforeach
                        </div>
                    </div>

                    <!-- Activities Section -->
                    <div class="card">
                        <div class="card-header">
                            <div class="card-actions float-end">
                                <div class="dropdown position-relative">
                                    <a href="#" data-bs-toggle="dropdown" data-bs-display="static">
                                        <i class="align-middle" data-lucide="more-horizontal"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a class="dropdown-item" href="#">Action</a>
                                        <a class="dropdown-item" href="#">Another action</a>
                                        <a class="dropdown-item" href="#">Something else here</a>
                                    </div>
                                </div>
                            </div>
                            <h5 class="card-title mb-0">Activities</h5>
                        </div>
                        <div class="card-body h-100">
                            @foreach ($activities as $activity)
                                <div class="d-flex align-items-start">
                                    <img src="{{ asset('storage/' . $activity->user->avatar) }}" width="36"
                                        height="36" class="rounded-circle me-2"
                                        alt="{{ $activity->user->name }}">
                                    <div class="flex-grow-1">
                                        <small class="float-end">{{ $activity->created_at->diffForHumans() }}</small>
                                        <strong>{{ $activity->user->name }}</strong>
                                        {{ $activity->description }}<br />
                                        <small class="text-muted">{{ $activity->created_at->format('h:i a') }}</small>
                                        @if ($activity->image)
                                            <div class="row g-0 mt-1">
                                                @foreach ($activity->images as $image)
                                                    <div class="col-6 col-md-4 col-lg-4 col-xl-3">
                                                        <img src="{{ asset('storage/' . $image) }}"
                                                            class="img-fluid pe-2" alt="Activity Image">
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <hr />
                            @endforeach
                            <div class="d-grid">
                                <a href="#" class="btn btn-primary">Load more</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>


    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        document.getElementById('comment-form').addEventListener('submit', function(e) {
            e.preventDefault();

            var formData = new FormData(this);

            axios.post('{{ route('comments.store') }}', formData)
                .then(function(response) {
                    var comment = response.data.comment;
                    var user = response.data.user;

                    var profilePicture = user.profile_picture ?
                        `/storage/profile_pictures/${user.profile_picture}` :
                        `/storage/profile_pictures/default-user.png`;

                    var commentCard = `
                                        <div class="card mb-2">
                                            <div class="card-body">
                                                <a href="/profile/${user.username}" class="d-flex align-items-center">
                                                    <img id="post-user-profile" src="${profilePicture}" width="30" height="30" class="rounded-circle me-2 border border-sm">
                                                    <h5 class="mb-0 d-inline">${user.username}</h5>
                                                </a>
                                                <p class="card-text">${comment.content}</p>
                                            </div>
                                        </div>
                                    `;

                    document.getElementById('comments-container').insertAdjacentHTML('afterbegin', commentCard);

                    document.querySelector('#comment-form textarea').value = '';

                })
                .catch(function(error) {
                    console.error('Error posting comment:', error);
                });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            document.querySelectorAll('.btn-delete-post').forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    const postId = this.getAttribute('data-id');
                    const form = document.getElementById(`delete-form-${postId}`);

                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });

            document.querySelectorAll('.btn-edit-post').forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    const postId = this.getAttribute('data-id');
                    const editUrl = this.getAttribute('href'); // URL to the edit form

                    if (!editUrl) {
                        return;
                    }

                    Swal.fire({
                        title: 'Are you sure?',
                        text: "Do you want to edit this post?",
                        icon: 'info',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, proceed!',
                        cancelButtonText: 'Cancel'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = editUrl; // Redirect to the edit URL
                        }
                    });
                });
            });


            var modalElement = document.getElementById('view-post');
            var commentForm = document.getElementById('comment-form');
            var commentsContainer = document.getElementById('comments-container');
            var postIdInput = document.querySelector('input[name="post_id"]');
            var editPostLink = document.getElementById('edit-post-link');
            var deletePostForm = document.getElementById('delete-post-form');

            modalElement.addEventListener('show.bs.modal', function(event) {
                var button = event.relatedTarget;

                var postId = button.getAttribute('data-post-id');
                var postContent = button.getAttribute('data-post-content');
                var postImage = button.getAttribute('data-post-image');
                var userLink = button.getAttribute('data-user-link');
                var userName = button.getAttribute('data-user-name');
                var userProfile = button.getAttribute('data-user-profile');

                modalElement.querySelector('#post-content').textContent = postContent;
                modalElement.querySelector('#modal-post-image').src = postImage;
                modalElement.querySelector('#post-user-link').href = userLink;
                modalElement.querySelector('#post-user-name').textContent = userName;
                modalElement.querySelector('#post-user-profile').src = userProfile;

                // Set up the form actions
                postIdInput.value = postId;
                editPostLink.href = `/posts/${postId}/edit`;
                deletePostForm.action = `/posts/${postId}`;

                // Fetch comments
                fetch(`/posts/${postId}/comments`)
                    .then(response => response.json())
                    .then(data => {
                        commentsContainer.innerHTML = '';
                        data.comments.forEach(comment => {
                            var commentElement = `
                                                    <div class="card mb-2">
                                                        <div class="card-body">
                                                            <a href="/profile/${comment.user.username}" class="d-flex align-items-center">
                                                                <img src="${comment.user.profile_picture ? '/storage/profile_pictures/' + comment.user.profile_picture : '/storage/profile_pictures/default-user.png'}" width="30" height="30" class="rounded-circle me-2 border border-sm">
                                                                <h5 class="mb-0 d-inline">${comment.user.username}</h5>
                                                            </a>
                                                            <p class="card-text">${comment.content}</p>
                                                        </div>
                                                    </div>
                                                `;
                            commentsContainer.insertAdjacentHTML('beforeend', commentElement);
                        });
                    })
                    .catch(error => console.error('Error fetching comments:', error));
            });

            // Handle comment form submission
            commentForm.addEventListener('submit', function(event) {
                event.preventDefault();

                var formData = new FormData(commentForm);

                fetch(commentForm.action, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': formData.get('_token')
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            document.getElementById('content').value = '';

                            var newComment = `
                                                <div class="card mb-2">
                                                    <div class="card-body">
                                                        <a href="/profile/${data.comment.user.username}" class="d-flex align-items-center">
                                                            <img src="${data.comment.user.profile_picture ? '/storage/profile_pictures/' + data.comment.user.profile_picture : '/storage/profile_pictures/default-user.png'}" width="30" height="30" class="rounded-circle me-2 border border-sm">
                                                            <h5 class="mb-0 d-inline">${data.comment.user.username}</h5>
                                                        </a>
                                                        <p class="card-text">${data.comment.content}</p>
                                                    </div>
                                                </div>
                                            `;
                            commentsContainer.insertAdjacentHTML('beforeend', newComment);
                        } else {
                            alert('Failed to post comment');
                        }
                    })
                    .catch(error => console.error('Error posting comment:', error));
            });

        });
    </script>

</x-app-layout>
