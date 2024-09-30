<x-app-layout>
    <style>
        /* html,
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
        } */
    </style>

    {{-- <div class="container-fluid">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <div class="row">
            <div class="col-12 col-md-3 left-column  d-none d-md-block">
                <div class="card mb-3 bg-transparent border-0 shadow-none">
                    <div class="card-body text-center">
                        <ul class="list-unstyled">
                            <li class="mb-1">
                                <a href="{{ route('profile.show', Auth::user()->username) }}"
                                    class="btn btn-lg text-dark w-100 text-start hover-effect d-flex align-items-center">
                                    <img src="{{ Auth::user()->profile_picture ? asset('storage/' . Auth::user()->profile_picture) : asset('storage/profile_pictures/default-user.png') }}"
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
                                    <i class="fas fa-user-friends me-2 icon-large text-primary"></i>
                                    Friends
                                </a>
                            </li>
                            <li class="mb-1">
                                <a href="#"
                                    class="btn btn-lg text-dark w-100 text-start hover-effect d-flex align-items-center">
                                    <i class="fas fa-clock me-2 icon-large text-warning"></i>
                                    Memories
                                </a>
                            </li>
                            <li class="mb-1">
                                <a href="#"
                                    class="btn btn-lg text-dark w-100 text-start hover-effect d-flex align-items-center">
                                    <i class="fas fa-users me-2 icon-large text-success"></i>
                                    Groups
                                </a>
                            </li>
                            <li class="mb-1">
                                <a href="#"
                                    class="btn btn-lg text-dark w-100 text-start hover-effect d-flex align-items-center">
                                    <i class="fas fa-bookmark me-2 icon-large text-info"></i>
                                    Saved
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('watch.index') }}"
                                    class="btn btn-lg text-dark w-100 text-start hover-effect d-flex align-items-center">
                                    <i class="fas fa-video me-2 icon-large text-danger"></i>
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
                                        <img src="{{ Auth::user()->profile_picture ? asset('storage/' . Auth::user()->profile_picture) : asset('storage/profile_pictures/default-user.png') }}"
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
                                            <i class="fas fa-video me-2 icon-large text-danger"></i>
                                            <span class="align-middle fw-bold">Live video</span>
                                        </button>

                                        <button type="button" class="btn btn-lg me-2 d-flex align-items-center"
                                            data-bs-toggle="modal" data-bs-target="#whats-on-your-mind"
                                            style="background-color: transparent; border: 1px solid transparent;"
                                            onmouseover="this.style.backgroundColor='#EBEBEB'; this.style.borderColor='#EBEBEB';"
                                            onmouseout="this.style.backgroundColor='transparent'; this.style.borderColor='transparent';">
                                            <i class="fa-solid fa-images me-2 icon-large text-primary"></i>
                                            <span class="align-middle fw-bold">Photo/Video</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                @forelse ($posts as $post)
                    <x-modal name="view-post" maxWidth="lg" centered="true" title="Post Details" focusable>
                        <div class="container d-flex flex-column" style="min-height: 400px;">
                            <div class="row flex-grow-1">

                                <!-- Media Column -->
                                <div class="col-md-5 bg-light d-none d-md-block" id="media-column">
                                    <div id="post-media-container" class="mb-3" style="max-height: 500px;">
                                        <img id="modal-post-image" class="img-fluid w-100 h-100 d-none"
                                            style="object-fit: contain;">
                                        <video id="modal-post-video" class="img-fluid w-100 h-100 d-none" controls
                                            style="object-fit: contain;"></video>
                                    </div>
                                </div>

                                <!-- Content Column -->
                                <div class="col-md-7 d-flex flex-column">
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
                                    <p id="post-content" class="flex-grow-1"></p>

                                    <!-- Comments Section -->
                                    <div class="mt-auto">
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
                                                            <textarea id="content" name="content" class="form-control form-control-lg" style="resize: none;"
                                                                placeholder="Comment as {{ $post->user->firstname }} {{ $post->user->lastname }}" required></textarea>
                                                            <button type="submit" class="btn btn-primary btn-lg">
                                                                <i class="align-middle" data-lucide="send-horizontal"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        @endauth
                                    </div>
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
                                        <img id="edit-post-image" class="img-fluid w-100 h-100"
                                            style="object-fit: contain;"
                                            src="{{ asset('storage/' . $post->post_media) }}">

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
                                                            <img src='{{ $post->user->profile_picture ? asset('storage/' . $post->user->profile_picture) : asset('storage/profile_pictures/default-user.png') }}' width='100' height='100' class='rounded-circle mb-2' style='max-width: 100%; max-height: 100%; object-fit: contain;'>
                                                            <a href='{{ route('profile.show', $post->user->username) }}'>
                                                                <h5 class='fw-bolder'>{{ $post->user->username }}</h5>
                                                            </a>
                                                            <h5>{{ $post->user->firstname }} {{ $post->user->lastname }}</h5>
                                                            <p>{{ $post->user->bio ?? 'No bio available' }}</p>
                                                        </div>">
                                    <img src="{{ $post->user->profile_picture ? asset('storage/' . $post->user->profile_picture) : asset('storage/profile_pictures/default-user.png') }}"
                                        width="50" height="50" class="rounded-circle me-3 border border-sm"
                                        alt="{{ $post->user->firstname }}">
                                </a>

                                <div class="flex-grow-1">
                                    <div class="flex-grow-1 d-flex justify-content-between align-items-center">
                                        <a href="{{ route('profile.show', $post->user->username) }}"
                                            class="text-decoration-none text-dark" data-bs-toggle="popover"
                                            data-bs-trigger="hover" data-bs-placement="bottom" data-bs-html="true"
                                            data-bs-content="<div class='text-center'>
                                                                    <img src='{{ $post->user->profile_pictures ? asset('storage/' . $post->user->profile_pictures) : asset('storage/profile_pictures/default-user.png') }}' width='100' height='100' class='rounded-circle mb-2'>
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

                                        </a>
                                        <a class="nav-link d-none d-sm-inline-block cursor-pointer"
                                            data-bs-toggle="dropdown" data-lucide="ellipsis-vertical">
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            @if (Auth::id() === $post->user_id)
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
                                                    Archive Post
                                                </a>
                                                <a class='dropdown-item btn-save-feed' href="#">
                                                    <i class="align-middle me-1" data-lucide="save"></i>
                                                    Save Post
                                                </a>
                                                <a class='dropdown-item btn-remove-feed' href="#">
                                                    <i class="align-middle me-1" data-lucide="remove"></i>
                                                    Remove from Feed
                                                </a>
                                            @endif
                                        </div>

                                    </div>
                                    <p>{{ $post->content }}</p>


                                    @if ($post->post_media)
                                        <!-- Assuming you've renamed the column to 'media' -->

                                        @if (in_array(pathinfo($post->post_media, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif']))
                                            <a href="{{ route('posts.show_images', $post->id) }}" type="button"
                                                class="decoration-none border-0">
                                                <img src="{{ asset('storage/' . $post->post_media) }}"
                                                    class="img-fluid pe-1" alt="{{ $post->content }}">
                                            </a>
                                        @elseif (in_array(pathinfo($post->post_media, PATHINFO_EXTENSION), ['mp4', 'mov', 'avi']))
                                            <a href="{{ route('posts.show_videos', $post->id) }}" type="button"
                                                class="decoration-none border-0">
                                                <video class="img-fluid pe-1" width="420" height="240" controls>
                                                    <source src="{{ asset('storage/' . $post->post_media) }}"
                                                        type="video/mp4">
                                                    Your browser does not support the video tag.
                                                </video>
                                            </a>
                                        @endif
                                    @endif


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
                                            data-post-media="{{ asset('storage/' . $post->post_media) }}"
                                            data-media-type="{{ pathinfo($post->post_media, PATHINFO_EXTENSION) }}"
                                            data-user-link="{{ route('profile.show', $post->user->username) }}"
                                            data-user-name="{{ $post->user->username }}"
                                            data-user-profile="{{ $post->user->profile_picture ? asset('storage/' . $post->user->profile_picture) : asset('storage/profile_pictures/default-user.png') }}">

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
                    <h5 class="m-3 text-start">Recommended Users</h5>
                    @if ($recommendedUsers && $recommendedUsers->isNotEmpty())
                        @foreach ($recommendedUsers as $user)
                            <div class="card-body text-center">
                                <img src="{{ $user->profile_picture ? asset('storage/' . $user->profile_picture) : asset('storage/profile_pictures/default-user.png') }}"
                                    width="128" height="128"
                                    class="rounded-circle border border-light shadow-sm"
                                    alt="{{ $user->firstname }}">
                                <h4 class="card-title mb-0">{{ $user->firstname . ' ' . $user->lastname }}</h4>
                                <div class="text-muted mb-2">{{ $user->email }}</div>
                                <div class="d-flex flex-row justify-content-center gap-2">
                                    <form id="follow-form" action="{{ route('users.followToggle', $user->id) }}"
                                        method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-primary btn-sm" id="follow-button">
                                            {{ Auth::user()->isFollowing($user->id) ? 'Following' : 'Follow' }}
                                        </button>
                                    </form>
                                    <a class="btn btn-primary btn-sm"
                                        href="{{ route('messages.create', $user->id) }}">
                                        <span data-lucide="message-square"></span> Message
                                    </a>
                                </div>
                            </div>
                            <div class="hr-2"></div>
                        @endforeach
                    @else
                        <p>No recommended users at this time.</p>
                    @endif
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
                                <img src="{{ asset('storage/' . $activity->user->profile_picture) }}" width="36"
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

    </div> --}}

    <div class="content">
        <div class="pb-10">
            <div class="row gy-3 gx-5 gx-xxl-6">
                <div class="col-md-4 col-xl-3 d-none d-lg-block" style="margin-right: 2rem">
                    <div class="card mb-5">
                        <div class="card-header hover-actions-trigger position-relative mb-7" style="min-height: 130px; ">

                        </div>
                        <div class="card-body">

                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-xl-5">
                    <div class="card d-flex flex-column mb-5">
                        <textarea class="form-control border-translucent rounded-bottom-0 border-0 flex-1 fs-8" rows="5" style="resize: none"
                            placeholder="What's on your mind, {{ Auth::check() ? Auth::user()->firstname . ' ' . Auth::user()->lastname : 'Guest' }}">
                        </textarea>

                        <div class="card-footer p-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <button class="btn p-0 me-3">
                                    <span class="fa-solid fa-image fs-8"></span>
                                </button>
                                <button class="btn p-0 me-3">
                                    <span class="fa-solid fa-calendar-alt fs-8"></span>
                                </button>
                                <button class="btn p-0 me-3">
                                    <span class="fa-solid fa-map-marker-alt fs-8"></span>
                                </button>
                                <button class="btn p-0 me-3">
                                    <span class="fa-solid fa-tag fs-8"></span>
                                </button>
                                <div class="dropdown me-3 d-inline-block flex-1">
                                    <button
                                        class="btn p-0 dropdown-toggle dropdown-caret-none d-flex align-items-center"
                                        type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <span class="fa-solid fa-globe-asia fs-8 me-1"></span>
                                        <span class="me-1 lh-base d-none d-sm-block">Public</span>
                                        <span class="fa-solid fa-caret-down fs-10 text-body-quaternary"></span>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="#">Public</a></li>
                                        <li><a class="dropdown-item" href="#">Private</a></li>
                                        <li><a class="dropdown-item" href="#">Draft</a></li>
                                    </ul>
                                </div>
                                <div class="d-flex align-items-center">
                                    <button class="btn btn-primary btn-sm px-6 px-sm-8">Post</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-9">
                        @foreach ($posts as $post)
                            <div class="mb-5">
                                <div class="card mb-4">
                                    <div class="card-body p-3 p-sm-4">
                                        <div class="border-translucent mb-3">
                                            <div class="d-flex align-items-center mb-3">
                                                <a href="{{ route('profile.show', $post->user->username) }}">
                                                    <div class="avatar avatar-xl  me-2">
                                                        <img class="rounded-circle "
                                                            src="{{ asset('storage/' . $post->user->profile_picture) }}"
                                                            alt="" />
                                                    </div>
                                                </a>
                                                <div class="flex-1">
                                                    <a class="fw-bold mb-0 text-body-emphasis"
                                                        href="../../apps/social/profile.html">{{ $post->user->firstname }}
                                                        {{ $post->user->lastname }}</a>
                                                    <p
                                                        class="fs-10 mb-0 text-body-tertiary text-opacity-85 fw-semibold">
                                                        35 mins ago
                                                        <span
                                                            class="fa-solid fa-circle text-body-quaternary text-opacity-50"
                                                            data-fa-transform="shrink-10 down-2"></span>
                                                        Consett, UK
                                                        <span
                                                            class="fa-solid fa-circle text-body-quaternary text-opacity-50"
                                                            data-fa-transform="shrink-10 down-2"></span>
                                                        <span class="fa-solid fa-earth-americas text-body"></span>
                                                    </p>
                                                </div>
                                                <div class="btn-reveal-trigger">
                                                    <button
                                                        class="btn btn-sm dropdown-toggle dropdown-caret-none transition-none d-flex btn-reveal"
                                                        type="button" data-bs-toggle="dropdown" data-boundary="window"
                                                        aria-haspopup="true" aria-expanded="false"
                                                        data-bs-reference="parent">
                                                        <span class="fas fa-ellipsis-h"></span>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-end py-2">
                                                        <a class="dropdown-item" href="#!">Edit</a>
                                                        <a class="dropdown-item text-danger" href="#!">Delete</a>
                                                        <a class="dropdown-item" href="#!">Download</a>
                                                        <a class="dropdown-item" href="#!">Report abuse</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <p class="text-body-secondary">{{ $post->content }}</p>
                                            <div class="row g-1 mb-5">
                                                <div class="col-3">
                                                    <a href="{{ route('posts.show_images', $post->id) }}" data-gallery="gallery-posts-0">
                                                        <img class="rounded h-100 w-100"
                                                            src="{{ asset('storage/' . $post->post_media) }}"
                                                            alt="..." />
                                                    </a>
                                                </div>
                                                {{-- <div class="col-3">
                                                <a href="../../assets/img/gallery/18.png" data-gallery="gallery-posts-0">
                                                    <img class="rounded h-100 w-100" src="../../assets/img/gallery/18.png" alt="..." />
                                                </a>
                                            </div>
                                            <div class="col-6">
                                                <a href="../../assets/img/gallery/19.png" data-gallery="gallery-posts-0">
                                                    <img class="rounded h-100 w-100" src="../../assets/img/gallery/19.png" alt="..." />
                                                </a>
                                            </div> --}}
                                            </div>
                                        </div>
                                        <div class="d-flex">
                                            <button class="btn btn-link p-0 me-3 fs-10 fw-bolder" type="button">
                                                <span class="fa-solid fa-heart me-1"></span>
                                                {{ $post->user->likeCount() }} Like
                                            </button>
                                            <button class="btn btn-link text-body p-0 fs-10 me-3 fw-bolder"
                                                type="button">
                                                <span class="fa-solid fa-comment me-1"></span>
                                                {{ $post->user->commentCount() }} Comments
                                            </button>
                                            <button class="btn btn-link text-body p-0 fs-10 me-2 fw-bolder"
                                                type="button">
                                                <span class="fa-solid fa-share me-1"></span>
                                                56 Shares
                                            </button>
                                        </div>
                                    </div>
                                    <div class="bg-body-highlight border-top border-translucent p-3 p-sm-4">
                                        @php
                                            $limitedComments = $comments->slice(0, 3);
                                        @endphp

                                        @foreach ($limitedComments as $comment)
                                            <div class="d-flex align-items-start">
                                                <a href="{{ route('profile.show', $comment->user->username) }}">
                                                    <div class="avatar avatar-m  me-2">
                                                        <img class="rounded-circle "
                                                            src="{{ asset('storage/' . $user->profile_picture) ?? asset('storage/profile_pictures/default-png') }}"
                                                            alt="" />
                                                    </div>
                                                </a>
                                                <div class="flex-1">
                                                    <div class="d-flex align-items-center">
                                                        <a class="fw-bold mb-0 text-body-emphasis"
                                                            href="{{ route('profile.show', $comment->user->username) }}">
                                                            {{ $comment->user->firstname }}
                                                            {{ $comment->user->lastname }}
                                                        </a>
                                                        {{-- <span
                                                            class="text-body-tertiary text-opacity-85 fw-semibold fs-10 ms-2">
                                                            {{ customTimeDiff($comment->created_at) }}
                                                        </span> --}}
                                                    </div>

                                                    <p class="mb-0">{{ $comment->content }}</p>
                                                    <span class="btn btn-link p-0 text-body fw-bolder mb-2">
                                                        <span class="fw-bold fs-10">
                                                            {{ customTimeDiff($comment->created_at) }}
                                                        </span>
                                                    </span>
                                                    <button class="btn btn-link p-0 text-body fw-bolder mb-2"
                                                        type="button">
                                                        <span class="fw-bold fs-10">Like</span>
                                                    </button>
                                                    <button class="btn btn-link p-0 text-body fw-bolder mb-2"
                                                        type="button">
                                                        <span class="fa-solid fa-reply fs-10 me-1"></span>
                                                        <span class="fw-bold fs-10">Reply</span>
                                                    </button>
                                                    {{-- <div class="d-flex align-items-start mb-3">
                                                        <a href="../../apps/social/profile.html">
                                                            <div class="avatar avatar-m  me-2">
                                                                <img class="rounded-circle " src="../../assets/img//team/62.webp"
                                                                    alt="" />
                                                            </div>
                                                        </a>
                                                        <div class="flex-1">
                                                            <div class="d-flex align-items-center">
                                                                <a class="fw-bold mb-0 text-body-emphasis" href="../../apps/social/profile.html">
                                                                    Zingko Kudobum
                                                                </a>
                                                                <span class="text-body-tertiary text-opacity-85 fw-semibold fs-10 ms-2">
                                                                    5 mins ago
                                                                </span>
                                                            </div>
                                                            <p class="mb-0">I am so clever that sometimes I don't
                                                                understand a single word of what I am saying.</p>
                                                        </div>
                                                    </div> --}}
                                                </div>
                                            </div>
                                        @endforeach

                                        <div class="d-flex align-items-center">
                                            <a href="../../apps/social/profile.html">
                                                <div class="avatar avatar-m  me-2">
                                                    <img class="rounded-circle "
                                                        src="{{ asset('storage/' . $user->profile_picture) ?? asset('storage/profile_pictures/default.png') }}"
                                                        alt="" />
                                                </div>
                                            </a>
                                            <div class="flex-1">
                                                <input class="form-control" type="text"
                                                    placeholder="Comment as {{ $user->firstname }} {{ $user->lastname }}" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="text-center"><a class="btn btn-link fs-8 p-0" href="#!">Load more</a></div>
                </div>
                <div class="col-md-4 col-xl-3 d-none d-lg-block">

                </div>
            </div>
        </div>
        <div class="navbar-bottom d-lg-none">
            <div class="nav">
                <a class="nav-link active" aria-current="page" href="{{ route('home') }}">
                    <span class="fa-solid fa-home nav-icon"></span>
                    <span class="nav-label">Home</span>
                </a>
                <a class="nav-link" href="{{ route('profile.show', Auth::user()->username) }}">
                    <span class="fa-solid fa-user nav-icon"></span>
                    <span class="nav-label">Profile</span>
                </a>
                <a class="nav-link" href="#!">
                    <span class="fa-solid fa-image nav-icon"></span>
                    <span class="nav-label">Photos</span>
                </a>
                <a class="nav-link" href="#!">
                    <span class="fa-solid fa-message nav-icon"></span>
                    <span class="nav-label">Messages</span>
                </a>
                <a class="nav-link" href="#!">
                    <span class="fa-solid fa-calendar-days nav-icon"></span>
                    <span class="nav-label">Events</span>
                </a>
            </div>
        </div>
    </div>
    <div class="modal fade" id="searchBoxModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="true"
        data-phoenix-modal="data-phoenix-modal" style="--phoenix-backdrop-opacity: 1;">
        <div class="modal-dialog">
            <div class="modal-content mt-15 rounded-pill">
                <div class="modal-body p-0">
                    <div class="search-box navbar-top-search-box" data-list='{"valueNames":["title"]}'
                        style="width: auto;">
                        <form class="position-relative" data-bs-toggle="search" data-bs-display="static"><input
                                class="form-control search-input fuzzy-search rounded-pill form-control-lg"
                                type="search" placeholder="Search..." aria-label="Search" />
                            <span class="fas fa-search search-box-icon"></span>
                        </form>
                        <div class="btn-close position-absolute end-0 top-50 translate-middle cursor-pointer shadow-none"
                            data-bs-dismiss="search"><button class="btn btn-link p-0" aria-label="Close"></button>
                        </div>
                        <div class="dropdown-menu border start-0 py-0 overflow-hidden w-100">
                            <div class="scrollbar-overlay" style="max-height: 30rem;">
                                <div class="list pb-3">
                                    <h6 class="dropdown-header text-body-highlight fs-10 py-2">24 <span
                                            class="text-body-quaternary">results</span></h6>
                                    <hr class="my-0" />
                                    <h6
                                        class="dropdown-header text-body-highlight fs-9 border-translucent py-2 lh-sm">
                                        Recently Searched </h6>
                                    <div class="py-2"><a class="dropdown-item"
                                            href="../../apps/e-commerce/landing/product-details.html">
                                            <div class="d-flex align-items-center">
                                                <div class="fw-normal text-body-highlight title"><span
                                                        class="fa-solid fa-clock-rotate-left"
                                                        data-fa-transform="shrink-2"></span> Store Macbook</div>
                                            </div>
                                        </a>
                                        <a class="dropdown-item"
                                            href="../../apps/e-commerce/landing/product-details.html">
                                            <div class="d-flex align-items-center">
                                                <div class="fw-normal text-body-highlight title"> <span
                                                        class="fa-solid fa-clock-rotate-left"
                                                        data-fa-transform="shrink-2"></span> MacBook Air - 13″</div>
                                            </div>
                                        </a>
                                    </div>
                                    <hr class="my-0" />
                                    <h6
                                        class="dropdown-header text-body-highlight fs-9 border-translucent py-2 lh-sm">
                                        Products</h6>
                                    <div class="py-2"><a class="dropdown-item py-2 d-flex align-items-center"
                                            href="../../apps/e-commerce/landing/product-details.html">
                                            <div class="file-thumbnail me-2"><img
                                                    class="h-100 w-100 object-fit-cover rounded-3"
                                                    src="../../assets/img/products/60x60/3.png" alt="" />
                                            </div>
                                            <div class="flex-1">
                                                <h6 class="mb-0 text-body-highlight title">MacBook Air - 13″</h6>
                                                <p class="fs-10 mb-0 d-flex text-body-tertiary"><span
                                                        class="fw-medium text-body-tertiary text-opactity-85">8GB
                                                        Memory - 1.6GHz - 128GB Storage</span></p>
                                            </div>
                                        </a>
                                        <a class="dropdown-item py-2 d-flex align-items-center"
                                            href="../../apps/e-commerce/landing/product-details.html">
                                            <div class="file-thumbnail me-2"><img class="img-fluid"
                                                    src="../../assets/img/products/60x60/3.png" alt="" />
                                            </div>
                                            <div class="flex-1">
                                                <h6 class="mb-0 text-body-highlight title">MacBook Pro - 13″</h6>
                                                <p class="fs-10 mb-0 d-flex text-body-tertiary"><span
                                                        class="fw-medium text-body-tertiary text-opactity-85">30 Sep at
                                                        12:30 PM</span></p>
                                            </div>
                                        </a>
                                    </div>
                                    <hr class="my-0" />
                                    <h6
                                        class="dropdown-header text-body-highlight fs-9 border-translucent py-2 lh-sm">
                                        Quick Links</h6>
                                    <div class="py-2"><a class="dropdown-item"
                                            href="../../apps/e-commerce/landing/product-details.html">
                                            <div class="d-flex align-items-center">
                                                <div class="fw-normal text-body-highlight title"><span
                                                        class="fa-solid fa-link text-body"
                                                        data-fa-transform="shrink-2"></span> Support MacBook House
                                                </div>
                                            </div>
                                        </a>
                                        <a class="dropdown-item"
                                            href="../../apps/e-commerce/landing/product-details.html">
                                            <div class="d-flex align-items-center">
                                                <div class="fw-normal text-body-highlight title"> <span
                                                        class="fa-solid fa-link text-body"
                                                        data-fa-transform="shrink-2"></span> Store MacBook″</div>
                                            </div>
                                        </a>
                                    </div>
                                    <hr class="my-0" />
                                    <h6
                                        class="dropdown-header text-body-highlight fs-9 border-translucent py-2 lh-sm">
                                        Files</h6>
                                    <div class="py-2"><a class="dropdown-item"
                                            href="../../apps/e-commerce/landing/product-details.html">
                                            <div class="d-flex align-items-center">
                                                <div class="fw-normal text-body-highlight title"><span
                                                        class="fa-solid fa-file-zipper text-body"
                                                        data-fa-transform="shrink-2"></span> Library MacBook folder.rar
                                                </div>
                                            </div>
                                        </a>
                                        <a class="dropdown-item"
                                            href="../../apps/e-commerce/landing/product-details.html">
                                            <div class="d-flex align-items-center">
                                                <div class="fw-normal text-body-highlight title"> <span
                                                        class="fa-solid fa-file-lines text-body"
                                                        data-fa-transform="shrink-2"></span> Feature MacBook
                                                    extensions.txt</div>
                                            </div>
                                        </a>
                                        <a class="dropdown-item"
                                            href="../../apps/e-commerce/landing/product-details.html">
                                            <div class="d-flex align-items-center">
                                                <div class="fw-normal text-body-highlight title"> <span
                                                        class="fa-solid fa-image text-body"
                                                        data-fa-transform="shrink-2"></span> MacBook Pro_13.jpg</div>
                                            </div>
                                        </a>
                                    </div>
                                    <hr class="my-0" />
                                    <h6
                                        class="dropdown-header text-body-highlight fs-9 border-translucent py-2 lh-sm">
                                        Members</h6>
                                    <div class="py-2"><a class="dropdown-item py-2 d-flex align-items-center"
                                            href="../../pages/members.html">
                                            <div class="avatar avatar-l status-online  me-2 text-body">
                                                <img class="rounded-circle " src="../../assets/img/team/40x40/10.webp"
                                                    alt="" />
                                            </div>
                                            <div class="flex-1">
                                                <h6 class="mb-0 text-body-highlight title">Carry Anna</h6>
                                                <p class="fs-10 mb-0 d-flex text-body-tertiary">anna@technext.it</p>
                                            </div>
                                        </a>
                                        <a class="dropdown-item py-2 d-flex align-items-center"
                                            href="../../pages/members.html">
                                            <div class="avatar avatar-l  me-2 text-body">
                                                <img class="rounded-circle " src="../../assets/img/team/40x40/12.webp"
                                                    alt="" />
                                            </div>
                                            <div class="flex-1">
                                                <h6 class="mb-0 text-body-highlight title">John Smith</h6>
                                                <p class="fs-10 mb-0 d-flex text-body-tertiary">smith@technext.it</p>
                                            </div>
                                        </a>
                                    </div>
                                    <hr class="my-0" />
                                    <h6
                                        class="dropdown-header text-body-highlight fs-9 border-translucent py-2 lh-sm">
                                        Related Searches</h6>
                                    <div class="py-2"><a class="dropdown-item"
                                            href="../../apps/e-commerce/landing/product-details.html">
                                            <div class="d-flex align-items-center">
                                                <div class="fw-normal text-body-highlight title"><span
                                                        class="fa-brands fa-firefox-browser text-body"
                                                        data-fa-transform="shrink-2"></span> Search in the Web MacBook
                                                </div>
                                            </div>
                                        </a>
                                        <a class="dropdown-item"
                                            href="../../apps/e-commerce/landing/product-details.html">
                                            <div class="d-flex align-items-center">
                                                <div class="fw-normal text-body-highlight title"> <span
                                                        class="fa-brands fa-chrome text-body"
                                                        data-fa-transform="shrink-2"></span> Store MacBook″</div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <p class="fallback fw-bold fs-7 d-none">No Result Found.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="support-chat-container support-chat-bottom-lg">
        <div class="container-fluid support-chat">
            <div class="card bg-body-emphasis">
                <div class="card-header d-flex flex-between-center px-4 py-3 border-translucent">
                    <h5 class="mb-0 d-flex align-items-center gap-2">Demo widget<span
                            class="fa-solid fa-circle text-success fs-11"></span></h5>
                    <div class="btn-reveal-trigger"><button
                            class="btn btn-link p-0 dropdown-toggle dropdown-caret-none transition-none d-flex"
                            type="button" id="support-chat-dropdown" data-bs-toggle="dropdown"
                            data-boundary="window" aria-haspopup="true" aria-expanded="false"
                            data-bs-reference="parent"><span class="fas fa-ellipsis-h text-body"></span></button>
                        <div class="dropdown-menu dropdown-menu-end py-2" aria-labelledby="support-chat-dropdown"><a
                                class="dropdown-item" href="#!">Request a callback</a><a class="dropdown-item"
                                href="#!">Search in chat</a><a class="dropdown-item" href="#!">Show
                                history</a><a class="dropdown-item" href="#!">Report to Admin</a><a
                                class="dropdown-item btn-support-chat" href="#!">Close Support</a></div>
                    </div>
                </div>
                <div class="card-body chat p-0">
                    <div class="d-flex flex-column-reverse scrollbar h-100 p-3">
                        <div class="text-end mt-6"><a
                                class="mb-2 d-inline-flex align-items-center text-decoration-none text-body-emphasis bg-body-hover rounded-pill border border-primary py-2 ps-4 pe-3"
                                href="#!">
                                <p class="mb-0 fw-semibold fs-9">I need help with something</p><span
                                    class="fa-solid fa-paper-plane text-primary fs-9 ms-3"></span>
                            </a><a
                                class="mb-2 d-inline-flex align-items-center text-decoration-none text-body-emphasis bg-body-hover rounded-pill border border-primary py-2 ps-4 pe-3"
                                href="#!">
                                <p class="mb-0 fw-semibold fs-9">I can’t reorder a product I previously ordered</p>
                                <span class="fa-solid fa-paper-plane text-primary fs-9 ms-3"></span>
                            </a><a
                                class="mb-2 d-inline-flex align-items-center text-decoration-none text-body-emphasis bg-body-hover rounded-pill border border-primary py-2 ps-4 pe-3"
                                href="#!">
                                <p class="mb-0 fw-semibold fs-9">How do I place an order?</p><span
                                    class="fa-solid fa-paper-plane text-primary fs-9 ms-3"></span>
                            </a><a
                                class="false d-inline-flex align-items-center text-decoration-none text-body-emphasis bg-body-hover rounded-pill border border-primary py-2 ps-4 pe-3"
                                href="#!">
                                <p class="mb-0 fw-semibold fs-9">My payment method not working</p><span
                                    class="fa-solid fa-paper-plane text-primary fs-9 ms-3"></span>
                            </a></div>
                        <div class="text-center mt-auto">
                            <div class="avatar avatar-3xl status-online"><img
                                    class="rounded-circle border border-3 border-light-subtle"
                                    src="../../assets/img/team/30.webp" alt="" /></div>
                            <h5 class="mt-2 mb-3">Eric</h5>
                            <p class="text-center text-body-emphasis mb-0">Ask us anything – we’ll get back to you here
                                or by email within 24 hours.</p>
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center gap-2 border-top border-translucent ps-3 pe-4 py-3">
                    <div class="d-flex align-items-center flex-1 gap-3 border border-translucent rounded-pill px-4">
                        <input class="form-control outline-none border-0 flex-1 fs-9 px-0" type="text"
                            placeholder="Write message" /><label
                            class="btn btn-link d-flex p-0 text-body-quaternary fs-9 border-0"
                            for="supportChatPhotos"><span class="fa-solid fa-image"></span></label><input
                            class="d-none" type="file" accept="image/*" id="supportChatPhotos" /><label
                            class="btn btn-link d-flex p-0 text-body-quaternary fs-9 border-0"
                            for="supportChatAttachment"> <span class="fa-solid fa-paperclip"></span></label><input
                            class="d-none" type="file" id="supportChatAttachment" /></div><button
                        class="btn p-0 border-0 send-btn"><span class="fa-solid fa-paper-plane fs-9"></span></button>
                </div>
            </div>
        </div><button class="btn btn-support-chat p-0 border border-translucent"><span
                class="fs-8 btn-text text-primary text-nowrap">Chat demo</span><span
                class="ping-icon-wrapper mt-n4 ms-n6 mt-sm-0 ms-sm-2 position-absolute position-sm-relative"><span
                    class="ping-icon-bg"></span><span class="fa-solid fa-circle ping-icon"></span></span><span
                class="fa-solid fa-headset text-primary fs-8 d-sm-none"></span><span
                class="fa-solid fa-chevron-down text-primary fs-7"></span></button>
    </div> --}}
</x-app-layout>
