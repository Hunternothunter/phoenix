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
                                        <a href="{{ route('profile.index') }}">
                                            <img src="{{ Auth::user()->avatar ? asset('storage/' . Auth::user()->avatar) : asset('storage/profile-pictures/default-user.png') }}"
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
                                                What's on your mind, {{ Auth::user()->name }}?
                                            </button>
                                        </div>
                                        <hr class="my-2">

                                        <x-modal name="whats-on-your-mind" maxWidth="md" title="Create Post" focusable>
                                            <div class="row align-items-start">
                                                <!-- User Profile Section -->
                                                <div class="col-1 d-flex justify-content-center">
                                                    <img src="{{ Auth::user()->avatar ? asset('storage/profile-pictures/' . Auth::user()->avatar) : asset('storage/profile-pictures/default-user.png') }}"
                                                        width="50" height="50"
                                                        class="rounded-circle border border-light shadow-sm"
                                                        alt="{{ Auth::user()->name }}">
                                                </div>

                                                <!-- Input Field and Photo/Video Button Section -->
                                                <div class="col-11">
                                                    <div class="mb-3">
                                                        <textarea id="content" name="content" class="form-control custom-textarea" rows="3"
                                                            placeholder="What's on your mind?"></textarea>
                                                    </div>
                                                    <hr class="my-2">
                                                    <div class="d-flex align-items-center">
                                                        <button x-data=""
                                                            x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
                                                            type="button"
                                                            class="btn btn-lg me-2 d-flex align-items-center"
                                                            style="background-color: transparent; border: 1px solid transparent;"
                                                            onmouseover="this.style.backgroundColor='#EBEBEB'; this.style.borderColor='#EBEBEB';"
                                                            onmouseout="this.style.backgroundColor='transparent'; this.style.borderColor='transparent';">
                                                            <i class="align-middle fs-5 me-2" data-lucide="images"></i>
                                                            <span class="align-middle fs-5 fw-bold">Photo/Video</span>
                                                        </button>
                                                        <button type="submit"
                                                            class="btn btn-primary fs-5 fw-bold">Post</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </x-modal>

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

                    <div class="card rounded-4">
                        <div class="card-body h-100">
                            @foreach ($posts as $post)
                                <div class="d-flex align-items-start">
                                    <img src="{{ asset('storage/' . $post->user->avatar) }}" width="56"
                                        height="56" class="rounded-circle me-3" alt="{{ $post->user->name }}">
                                    <div class="flex-grow-1">
                                        <small class="float-end">{{ $post->created_at->diffForHumans() }}</small>
                                        <p class="mb-2"><strong>{{ $post->user->name }}</strong></p>
                                        <p>{{ $post->content }}</p>
                                        @if ($post->image)
                                            <div class="row g-0 mt-1">
                                                @foreach ($post->images as $image)
                                                    <div class="col-6">
                                                        <img src="{{ asset('storage/' . $image) }}"
                                                            class="img-fluid pe-1" alt="Post Image">
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endif
                                        <small
                                            class="text-muted">{{ $post->updated_at->format('h:i a') }}</small><br />
                                        <a href="#" class="btn btn-sm btn-danger mt-1"><i class="lucide-sm"
                                                data-lucide="heart"></i> Like</a>
                                        <!-- Include comments or other actions if needed -->
                                    </div>
                                </div>
                                <hr />
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Profile Section -->
                <div class="col-12 col-lg-4">
                    <div class="card mb-3">
                        <div class="card-body text-center">
                            <img src="{{ Auth::user()->avatar ? asset('storage/' . Auth::user()->avatar) : asset('storage/profile-pictures/default-user.png') }}"
                                width="128" height="128" class="rounded-circle border border-light shadow-sm"
                                alt="{{ Auth::user()->name }}">
                            <h4 class="card-title mb-0">{{ $user->name }}</h4>
                            <div class="text-muted mb-2">{{ $user->title }}</div>
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
</x-app-layout>
