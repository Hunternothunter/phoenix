<x-app-layout>
    <style>
        html,
        body {
            height: 100%;
            margin: 0;
            padding: 0;
        }

        .custom-textarea {
            border-radius: 20px;
            resize: none;
            padding: 10px;
        }

        .lucide-heart {
            color: gray;
            fill: none;
        }

        .liked .lucide-heart {
            color: red;
            fill: red;
        }

        .btn-transparent {
            background-color: transparent !important;
            border: none !important;
        }

        .hover-effect {
            background-color: transparent;
            border: none;
            transition: background-color 0.3s ease, color 0.3s ease;
            height: 3rem;
            display: flex;
            align-items: center;
            font-weight: 500;
            font-size: larger;
            justify-content: flex-start;
            padding-left: 1rem;
        }

        .hover-effect:hover {
            background-color: rgba(0, 0, 0, 0.1);
            color: #000;
        }

        .icon-large {
            font-size: 1.4rem;
            width: 2rem;
        }

        .left-column,
        .right-column {
            position: sticky;
            top: 0;
            height: 100vh;
        }

        .scrollable-content {
            height: 100%;
        }
    </style>

    <div class="container-fluid">
        {{-- <div class="container p-0"> --}}
        <div class="row">
            <div class="col-12 col-md-3 left-column  d-none d-md-block">
                <div class="card mb-3 bg-transparent border-0 shadow-none">
                    <div class="card-body text-center">
                        <ul class="list-unstyled">
                            <li class="mb-1">
                                <a href="{{ route('profile.show', Auth::user()->username) }}"
                                    class="btn btn-lg text-dark w-100 text-start hover-effect d-flex align-items-center">
                                    <img src="{{ Auth::user()->profile_pictures ? asset('storage/profile_pictures/' . Auth::user()->profile_pictures) : asset('storage/profile_pictures/default-user.png') }}"
                                        class="rounded-circle me-2" alt="{{ Auth::user()->firstname }}" width="35"
                                        height="35" style="border: 1px solid #f0f0f0;" />
                                    <div class="d-flex flex-column">
                                        <span class="text-dark">{{ Auth::user()->firstname }}
                                            {{ Auth::user()->lastname }}</span>
                                    </div>
                                </a>
                            </li>
                            <li class="mb-1">
                                <a href="#"
                                    class="btn btn-lg text-dark w-100 text-start hover-effect d-flex align-items-center">
                                    <i class="fas fa-user-friends me-2 icon-large"></i>
                                    Friends
                                </a>
                            </li>
                            <li class="mb-1">
                                <a href="#"
                                    class="btn btn-lg text-dark w-100 text-start hover-effect d-flex align-items-center">
                                    <i class="fas fa-clock me-2 icon-large"></i>
                                    Memories
                                </a>
                            </li>
                            <li class="mb-1">
                                <a href="#"
                                    class="btn btn-lg text-dark w-100 text-start hover-effect d-flex align-items-center">
                                    <i class="fas fa-users me-2 icon-large"></i>
                                    Groups
                                </a>
                            </li>
                            <li class="mb-1">
                                <a href="#"
                                    class="btn btn-lg text-dark w-100 text-start hover-effect d-flex align-items-center">
                                    <i class="fas fa-bookmark me-2 icon-large"></i>
                                    Saved
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('watch.index') }}"
                                    class="btn btn-lg text-dark w-100 text-start hover-effect d-flex align-items-center">
                                    <i class="fas fa-video me-2 icon-large"></i>
                                    Video
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-6 middle-column">
                <div class="card mb-3 rounded-4">
                    <div class="card-body">
                        <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row align-items-start">
                                <!-- User Profile Section -->
                                <div class="col-auto d-flex justify-content-center mb-2 mb-md-0">
                                    <a href="{{ route('profile.show', Auth::user()->username) }}">
                                        <img src="{{ Auth::user()->profile_pictures ? asset('storage/profile_pictures/' . Auth::user()->profile_pictures) : asset('storage/profile_pictures/default-user.png') }}"
                                            width="50" height="50"
                                            class="rounded-circle border border-light shadow-sm">
                                    </a>
                                </div>

                                <!-- Input Field and Photo/Video Button Section -->
                                <div class="col">
                                    <div class="mb-3">
                                        <button type="button"
                                            class="btn btn-light btn-lg w-100 h-100 fs-5 text-start rounded-5"
                                            data-bs-toggle="modal" data-bs-target="#whats-on-your-mind">
                                            What's on your mind, {{ Auth::user()->firstname }}?
                                        </button>
                                    </div>
                                    <hr class="my-2">

                                    @include('modals.create-post')

                                    <div class="d-flex flex-wrap align-items-center">
                                        <button type="button" class="btn btn-lg me-2 d-flex align-items-center"
                                            data-bs-toggle="modal" data-bs-target="#whats-on-your-mind"
                                            style="background-color: transparent; border: 1px solid transparent;"
                                            onmouseover="this.style.backgroundColor='#EBEBEB'; this.style.borderColor='#EBEBEB';"
                                            onmouseout="this.style.backgroundColor='transparent'; this.style.borderColor='transparent';">
                                            <i class="align-middle me-2" data-lucide="video"></i>
                                            <span class="align-middle fw-bold">Live video</span>
                                        </button>

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
                        </form>
                    </div>
                </div>

                @forelse ($posts as $post)
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
                    <x-modal name="view-post" maxWidth="lg" centered="true" title="Post details" focusable>
                        <div class="container">
                            <div class="row">
                                <!-- Image Column -->
                                <div class="col-md-5 bg-light d-none d-md-block" id="image-column">
                                    <div id="post-image-container" class="mb-3" style="max-height: 500px;">
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

                                    <div id="comments-container" style="max-height: 300px; overflow-y: auto;">
                                    </div>

                                    <!-- Add Comment Section -->
                                    @auth
                                        <div class="flex-grow-0 py-3 px-4 border-top">
                                            <form id="comment-form" method="POST">
                                                @csrf
                                                <input type="hidden" name="post_id" value="{{ $post->id }}">
                                                <div class="form-group">
                                                    <label for="message">Message:</label>
                                                    <div class="input-group">
                                                        <input type="text" id="content" name="content"
                                                            class="form-control form-control-lg"
                                                            placeholder="Comment as {{ $post->user->firstname }} {{ $post->user->lastname }}"
                                                            required>
                                                        <button type="submit" class="btn btn-primary btn-lg">
                                                            <i class="align-middle" data-lucide="send-horizontal"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        {{-- <form id="comment-form" method="POST">
                                                @csrf
                                                <input type="hidden" name="post_id" value="{{ $post->id }}">
                                                <div class="form-group">
                                                    <label for="content">Add a Comment</label>
                                                    <div class="row">
                                                        <div class="col">
                                                            <input type="text" id="content" name="content"
                                                                class="form-control form-control-lg"
                                                                placeholder="Comment as {{ $post->user->firstname }} {{ $post->user->lastname }}"
                                                                required>
                                                        </div>
                                                        <div class="col-auto">
                                                            <button type="submit" class="btn btn-primary btn-lg">
                                                                <i class="align-middle" data-lucide="send-horizontal"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form> --}}
                                    @endauth
                                </div>
                            </div>
                        </div>
                    </x-modal>

                    <x-modal name="edit-post" maxWidth="md" centered="true" title="Edit post" focusable>
                        <div class="container">
                            <form id="edit-post-form" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="row">
                                    <div class="mb-3">
                                        <div class="d-flex inline-block align-items-center gap-1">
                                            <img id="edit-user-profile-picture" src="#" width="30"
                                                height="30" class="rounded-circle border border-light shadow-sm">
                                            <h5 id="edit-user-username"></h5>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <input type="text" id="edit-post-content" name="content"
                                            class="form-control" rows="4" style="overflow: auto;"></input>
                                    </div>

                                    <div id="post-image-container" class="mb-3"
                                        style="max-height: 400px; display: none;">
                                        {{-- <img id="edit-post-image" class="img-fluid w-100 h-100" style="object-fit: contain;"> --}}
                                        <img id="edit-post-image" class="img-fluid w-100 h-100"
                                            style="object-fit: contain;"
                                            src="{{ asset('storage/' . $post->image) }}">

                                    </div>

                                    <div class="d-flex justify-content-center">
                                        <button type="submit"
                                            class="btn btn-primary btn-lg w-100 fs-larger">Save</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </x-modal>


                    <div class="card rounded-4 mb-3">
                        <div class="card-body h-100">
                            <div class="d-flex align-items-start">
                                <a href="{{ route('profile.show', $post->user->username) }}"
                                    class="text-decoration-none text-dark" data-bs-toggle="popover"
                                    data-bs-trigger="hover" data-bs-placement="bottom" data-bs-html="true"
                                    data-bs-content="<div class='text-center'>
                                                            <img src='{{ $post->user->profile_pictures ? asset('storage/profile_pictures/' . $post->user->profile_pictures) : asset('storage/profile_pictures/default-user.png') }}' width='100' height='100' class='rounded-circle mb-2'>
                                                            <a href='{{ route('profile.show', $post->user->username) }}'>
                                                                <h5 class='fw-bolder'>{{ $post->user->username }}</h5>
                                                            </a>
                                                            <h5>{{ $post->user->firstname }} {{ $post->user->lastname }}</h5>
                                                            <p>{{ $post->user->bio ?? 'No bio available' }}</p>
                                                        </div>">
                                    <img src="{{ $post->user->profile_pictures ? asset('storage/profile_pictures/' . $post->user->profile_pictures) : asset('storage/profile_pictures/default-user.png') }}"
                                        width="50" height="50" class="rounded-circle me-3 border border-sm"
                                        alt="{{ $post->user->firstname }}">
                                </a>

                                <div class="flex-grow-1">
                                    <div class="flex-grow-1 d-flex justify-content-between align-items-center">
                                        <a href="{{ route('profile.show', $post->user->username) }}"
                                            class="text-decoration-none text-dark" data-bs-toggle="popover"
                                            data-bs-trigger="hover" data-bs-placement="bottom" data-bs-html="true"
                                            data-bs-content="<div class='text-center'>
                                                                    <img src='{{ $post->user->profile_pictures ? asset('storage/profile_pictures/' . $post->user->profile_pictures) : asset('storage/profile_pictures/default-user.png') }}' width='100' height='100' class='rounded-circle mb-2'>
                                                                    <a href='{{ route('profile.show', $post->user->username) }}'>
                                                                        <h5 class='fw-bolder'>{{ $post->user->username }}</h5>
                                                                    </a>
                                                                    <h5>{{ $post->user->firstname }} {{ $post->user->lastname }}</h5>
                                                                    <p>{{ $post->user->bio ?? 'No bio available' }}</p>
                                                                </div>">
                                            <div class="d-flex align-items-center gap-2">
                                                <span class="fw-bold">
                                                    {{ $post->user->username }}
                                                </span>
                                                <span class="text-dark fw-bold">
                                                    {{ customTimeDiff($post->created_at) }}
                                                </span>
                                            </div>
                                            {{-- <div class='d-flex inline-flex align-item-center justify-content-center gap-2'>
                                                    <form id='follow-form'
                                                        action='{{ route('users.followToggle', $user->id) }}'
                                                        method='POST'>
                                                        @csrf
                                                        <button type='submit' class='btn btn-primary btn-sm'
                                                            id='follow-button'>
                                                            {{ Auth::user()->isFollowing($user->id) ? 'Following' : 'Follow' }}
                                                        </button>
                                                    </form>
                                                    <a class='btn btn-primary btn-sm'
                                                        href='{{ route('messages.create', $user->id) }}'>
                                                        <span data-lucide='message-square'></span> Message
                                                    </a>
                                                </div> --}}
                                        </a>
                                        <a class="nav-link d-none d-sm-inline-block cursor-pointer"
                                            data-bs-toggle="dropdown" data-lucide="ellipsis-vertical">
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            @if (Auth::id() === $post->user_id)
                                                {{-- <a class='dropdown-item btn-edit-post'
                                                        href="{{ route('posts.edit', $post->id) }}"
                                                        data-bs-toggle="modal" data-bs-target="#edit-post">
                                                        <i class="align-middle me-1" data-lucide="pencil"></i>
                                                        Edit Post
                                                    </a> --}}
                                                <a class='dropdown-item btn-edit-post'
                                                    data-post-id="{{ $post->id }}" data-bs-toggle="modal"
                                                    data-bs-target="#edit-post">
                                                    <i class="align-middle me-1" data-lucide="pencil"></i>
                                                    Edit Post
                                                </a>

                                                <form id="delete-form-{{ $post->id }}"
                                                    action="{{ route('posts.destroy', $post->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="dropdown-item btn-delete-post"
                                                        data-id="{{ $post->id }}" type="submit">
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
                                            data-user-profile="{{ $post->user->profile_pictures ? asset('storage/profile_pictures/' . $post->user->profile_pictures) : asset('storage/profile_pictures/default-user.png') }}">
                                            <img src="{{ asset('storage/' . $post->image) }}" class="img-fluid pe-1"
                                                alt="{{ $post->content }}">
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
                                            data-bs-target="#view-post" data-post-id="{{ $post->id }}"
                                            data-post-content="{{ $post->content }}"
                                            data-post-image="{{ asset('storage/' . $post->image) }}"
                                            data-user-link="{{ route('profile.show', $post->user->username) }}"
                                            data-user-name="{{ $post->user->username }}"
                                            data-user-profile="{{ $post->user->profile_pictures ? asset('storage/profile_pictures/' . $post->user->profile_pictures) : asset('storage/profile_pictures/default-user.png') }}">
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
                @empty
                    <div class="card rounded-4 mb-3 d-flex flex-column justify-content-center align-items-center py-3">
                        <i class="align-middle" data-lucide="frown"></i>
                        <h3>No post available</h3>
                    </div>
                @endforelse
            </div>

            <!-- Profile Section -->
            <div class="col-12 col-md-3 right-column  d-none d-md-block">
                <div class="card mb-3">
                    <div class="card-body text-center">
                        <img src="{{ Auth::user()->profile_pictures ? asset('storage/profile_pictures/' . Auth::user()->profile_pictures) : asset('storage/profile_pictures/default-user.png') }}"
                            width="128" height="128" class="rounded-circle border border-light shadow-sm"
                            alt="{{ Auth::user()->firstname }}">
                        <h4 class="card-title mb-0">{{ $user->firstname . ' ' . $user->lastname }}</h4>
                        <div class="text-muted mb-2">{{ $user->email }}</div>
                        <div>
                            <a class="btn btn-primary btn-sm"
                                href="{{ route('users.follow', $user->id) }}">Follow</a>
                            <a class="btn btn-primary btn-sm" href="{{ route('messages.create', $user->id) }}"><span
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
                                <img src="{{ $followedUser->profile_pictures ? asset('storage/profile_pictures' . $followedUser->profile_pictures) : asset('storage/profile_pictures/default-user.png') }}"
                                    width="30" height="30" class="rounded-circle me-2"
                                    alt="{{ $followedUser->user->firstname }}">
                                <div class="d-flex flex-column justify-content-center align-item-center">
                                    <p class="my-1">
                                        <strong> {{ $followedUser->user->username }}</strong>
                                    </p>
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
                                <img src="{{ asset('storage/' . $activity->user->profile_pictures) }}" width="36"
                                    height="36" class="rounded-circle me-2" alt="{{ $activity->user->name }}">
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
        {{-- </div> --}}

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

                    var profilePicture = user.profile_pictures ?
                        `/storage/profile_pictures/${user.profile_pictures}` :
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

                    document.querySelector('#comment-form input').textContent = '';

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
                        confirmButtonText: 'Yes, delete it!',
                        reverseButtons: true
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });
            @if (session('success'))
                Swal.fire({
                    title: 'Success',
                    text: "{{ session('success') }}",
                    icon: 'success',
                    timer: 2000,
                    showConfirmButton: false
                })
            @endif
            // document.querySelectorAll('.btn-edit-post').forEach(button => {
            //     button.addEventListener('click', function(e) {
            //         e.preventDefault();
            //         const postId = this.getAttribute('data-id');
            //         const editUrl = this.getAttribute('href'); // URL to the edit form

            //         if (!editUrl) {
            //             return;
            //         }

            //         Swal.fire({
            //             title: 'Are you sure?',
            //             text: "Do you want to edit this post?",
            //             icon: 'info',
            //             showCancelButton: true,
            //             confirmButtonColor: '#3085d6',
            //             cancelButtonColor: '#d33',
            //             confirmButtonText: 'Yes, proceed!',
            //             cancelButtonText: 'Cancel'
            //         }).then((result) => {
            //             if (result.isConfirmed) {
            //                 window.location.href = editUrl; // Redirect to the edit URL
            //             }
            //         });
            //     });
            // });

            const editButtons = document.querySelectorAll('.btn-edit-post');

            editButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const postId = this.getAttribute('data-post-id');

                    fetch(`/posts/${postId}/edit`)
                        .then(response => response.json())
                        .then(data => {

                            document.getElementById('edit-user-username').textContent =
                                data
                                .user.username;
                            document.getElementById('edit-user-profile-picture').src =
                                data.user
                                .profile_pictures ?
                                `/storage/profile_pictures/${data.user.profile_pictures}` :
                                '/storage/profile_pictures/default-user.png';

                            document.getElementById('edit-post-content').value = data
                                .content;

                            const postImageContainer = document.getElementById(
                                'post-image-container');
                            const postImage = document.getElementById(
                                'edit-post-image');
                            console.log(data.image);

                            if (data.image) {
                                postImage.src = `/storage/${data.image}`;
                                postImageContainer.style.display = 'block';
                            } else {
                                postImage.src = '/storage/default-post.jpg';
                                postImageContainer.style.display = 'block';
                            }

                            const form = document.getElementById('edit-post-form');
                            form.action = `/posts/${postId}`;
                        })
                        .catch(error => console.error('Error fetching post:', error));
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

                // Handle image display
                var imageColumn = modalElement.querySelector('#post-image-container');
                var modalPostImage = modalElement.querySelector('#modal-post-image');
                if (postImage) {
                    modalPostImage.src = postImage;
                    modalPostImage.style.display = 'block'; // Ensure image is visible
                    imageColumn.style.display = 'block'; // Show image column
                } else {
                    modalPostImage.style.display = 'none'; // Hide image if not available
                    imageColumn.style.display = 'none'; // Hide image column
                }

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
                                                                <img src="${comment.user.profile_pictures ? '/storage/profile_pictures/' + comment.user.profile_pictures : '/storage/profile_pictures/default-user.png'}" width="30" height="30" class="rounded-circle me-2 border border-sm">
                                                                <h5 class="mb-0 d-inline">${comment.user.username}</h5>
                                                            </a>
                                                            <p class="card-text">${comment.content}</p>
                                                        </div>
                                                    </div>
                                                `;
                            commentsContainer.insertAdjacentHTML('beforeend',
                                commentElement);
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
                                                            <img src="${data.comment.user.profile_pictures ? '/storage/profile_pictures/' + data.comment.user.profile_pictures : '/storage/profile_pictures/default-user.png'}" width="30" height="30" class="rounded-circle me-2 border border-sm">
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


            var popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]');
            var popoverList = [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(
                popoverTriggerEl));

            popoverTriggerList.forEach(trigger => {
                trigger.addEventListener('mouseenter', function() {
                    var popover = bootstrap.Popover.getInstance(trigger);
                    if (popover) {
                        popover.show();
                    }
                });

                // trigger.addEventListener('mouseleave', function() {
                //     var popover = bootstrap.Popover.getInstance(trigger);
                //     if (popover) {
                //         // Delay hiding to allow interaction with popover content
                //         setTimeout(() => {
                //             if (!popover._isShown) {
                //                 popover.hide();
                //             }
                //         }, 100);
                //     }
                // });

                trigger.addEventListener('shown.bs.popover', function() {
                    var popoverElement = document.querySelector('.popover');
                    if (popoverElement) {
                        popoverElement.addEventListener('mouseenter', function() {
                            // Keep popover visible when hovering over its content
                            popover.show();
                        });

                        popoverElement.addEventListener('mouseleave', function() {
                            // Hide popover when cursor leaves popover content
                            popover.hide();
                        });
                    }
                });
            });

        });
    </script>

</x-app-layout>
