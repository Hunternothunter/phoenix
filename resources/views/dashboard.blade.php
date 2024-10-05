<x-app-layout>
    <style>
        .left-column,
        .right-column {
            position: sticky;
            top: 6rem;
            height: 100vh;
        }

        .scrollable-content {
            height: 100%;
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

        #promptTextarea {
            overflow: hidden;
            resize: none;
        }
    </style>

    <div class="content">
        <div class="pb-10">
            <div class="row gy-3 gx-5 gx-xxl-6">
                <div class="col-md-4 col-xl-3 d-none d-lg-block left-column"
                    style="margin-right: 4rem; margin-left:-2rem;">
                    <div class="card mb-5 bg-transparent border-0">
                        <div class="card-body">
                            <ul class="navbar-nav">
                                <li class="nav-item mb-3">
                                    <a href="{{ route('profile.show', Auth::user()->username) }}"
                                        class="btn btn-lg text-dark w-100 text-start hover-effect d-flex align-items-center">
                                        <img src="{{ Auth::user()->profile_picture ? asset('storage/' . Auth::user()->profile_picture) : asset('storage/profile_pictures/default-user.png') }}"
                                            class="rounded-circle me-3" alt="{{ Auth::user()->firstname }}"
                                            width="35" height="35" style="border: 1px solid #f0f0f0;" />
                                        <div class="d-flex flex-column">
                                            <span class="text-dark">{{ Auth::user()->firstname }}
                                                {{ Auth::user()->lastname }}</span>
                                        </div>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link lh-1 mb-2 hover-effect" href="#!">
                                        <span class="fa-solid fa-user-group text-primary fa-lg me-3"></span>
                                        Friends
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link lh-1 mb-2 hover-effect" href="#!">
                                        <span class="fa-solid fa-users text-success fa-lg me-3"></span>
                                        Groups
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link lh-1 mb-2 hover-effect" href="{{ route('watch.index') }}">
                                        <span class="fa-solid fa-video text-danger fa-lg me-3"></span>
                                        Video
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 col-xl-5 middle-column">
                    <div class="card d-flex flex-column mb-5">
                        {{-- @include('modals.create-post') --}}

                        {{-- <button type="button" data-bs-toggle="modal" data-bs-target="#whats-on-your-mind">
                            What's on your mind,
                            {{ Auth::check() ? Auth::user()->firstname . ' ' . Auth::user()->lastname : 'Guest' }}
                        </button> --}}

                        <form action="{{ route('posts.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('POST')

                            {{-- <textarea class="form-control border-translucent rounded-bottom-0 border-0 flex-1 fs-8" name="content" id="content"
                                rows="5" placeholder="What's on your mind, {{ Auth::check() ? Auth::user()->firstname : 'Guest' }}">
                            </textarea> --}}
                            <textarea id="promptTextarea" class="form-control border-translucent border-0 flex-1 fs-8" rows="4"
                                placeholder="What's on your mind, {{ Auth::check() ? Auth::user()->firstname : 'Guest' }}"
                                oninput="autoResize(this)"></textarea>

                            <div id="preview" class="m-3 d-flex flex-wrap d-none"></div>

                            <div class="card-footer p-3">
                                <div class="d-flex justify-content-between align-items-center cursor-pointer">
                                    <input type="file" name="post_media" id="post_media" class="btn p-0 me-3"
                                        accept="image/*, video/*" style="display: none;"
                                        onchange="handleFiles(this.files)">
                                    <span class="fa-solid fa-image fs-8"
                                        onclick="document.getElementById('post_media').click();"
                                        name="post_media"></span>
                                    <input type="button" class="btn p-0 me-3">
                                    <span class="fa-solid fa-calendar-alt fs-8"></span>
                                    </input>
                                    <input type="button" class="btn p-0 me-3">
                                    <span class="fa-solid fa-map-marker-alt fs-8"></span>
                                    </input>
                                    <input type="button" class="btn p-0 me-3">
                                    <span class="fa-solid fa-tag fs-8"></span>
                                    </input>
                                    <div class="dropdown ms-3 me-3 d-inline-block flex-1">
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
                        </form>
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
                                                            src="{{ asset('storage/' . $post->user->profile_picture) ?? asset('storage/profile_pictures/default-user.png') }}"
                                                            alt="" />
                                                    </div>
                                                </a>
                                                <div class="flex-1">
                                                    <a class="fw-bold mb-0 text-body-emphasis"
                                                        href="{{ route('profile.show', $post->user->username) }}">
                                                        {{ $post->user->firstname }} {{ $post->user->lastname }}
                                                        @if ($post->user->is_verified)
                                                            <span
                                                                class="fa-solid fa-check-circle text-primary ms-1 fa-xs"
                                                                title="Verified"></span>
                                                        @endif
                                                    </a>
                                                    <p
                                                        class="fs-10 mb-0 text-body-tertiary text-opacity-85 fw-semibold">
                                                        <a href="{{ route('posts.show', $post->id) }}"
                                                            class="text-body">
                                                            {{ customTimeDiff($post->created_at) }}
                                                        </a>
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
                                                        type="button" data-bs-toggle="dropdown"
                                                        data-boundary="window" aria-haspopup="true"
                                                        aria-expanded="false" data-bs-reference="parent">
                                                        <span class="fas fa-ellipsis-h"></span>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-end py-2">
                                                        <a class="dropdown-item" href="#!">Edit</a>
                                                        <form id="deletePostForm-{{ $post->id }}"
                                                            action="{{ route('posts.destroy', $post->id) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button" class="dropdown-item text-danger"
                                                                onclick="confirmDelete({{ $post->id }})">
                                                                Delete
                                                            </button>
                                                        </form>
                                                        <a class="dropdown-item" href="#!">Download</a>
                                                        <a class="dropdown-item" href="#!">Report abuse</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <p class="text-body-secondary">{{ $post->content }}</p>
                                            <div class="row g-1 mb-5 d-flex justify-content-center align-center">
                                                <div class="col-10">
                                                    @if (in_array(pathinfo($post->post_media, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif']))
                                                        <a href="{{ route('posts.show_images', $post->id) }}"
                                                            data-gallery="gallery-posts-0">
                                                            <img class="rounded h-100 w-100"
                                                                src="{{ asset('storage/' . $post->post_media) }}"
                                                                alt="..." />
                                                        </a>
                                                    @elseif (in_array(pathinfo($post->post_media, PATHINFO_EXTENSION), ['mp4', 'mov', 'avi']))
                                                        <a href="{{ route('posts.show_videos', $post->id) }}"
                                                            type="button" class="decoration-none border-0">
                                                            <video class="img-fluid pe-1" width="1280"
                                                                height="720" controls>
                                                                <source
                                                                    src="{{ asset('storage/' . $post->post_media) }}"
                                                                    type="video/mp4">
                                                                Your browser does not support the video tag.
                                                            </video>
                                                        </a>
                                                    @endif
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
                                            @if ($post->likes->contains('user_id', auth()->id()))
                                                <a href="javascript:void(0);"
                                                    class="btn btn-link p-0 me-3 fs-10 fw-bolder toggle-like"
                                                    data-post-id="{{ $post->id }}">
                                                    <span class="fa-solid fa-heart me-1"></span>
                                                    <span class="like-count">{{ $post->likes()->count() }}</span>
                                                    Liked
                                                </a>
                                            @else
                                                <a href="javascript:void(0);"
                                                    class="btn btn-link text-body p-0 me-3 fs-10 fw-bolder toggle-like"
                                                    data-post-id="{{ $post->id }}">
                                                    <span class="fa-solid fa-heart me-1"></span>
                                                    <span class="like-count">{{ $post->likes()->count() }}</span> Like
                                                </a>
                                            @endif

                                            <button class="btn btn-link text-body p-0 fs-10 me-3 fw-bolder"
                                                type="button">
                                                <span class="fa-solid fa-comment me-1"></span>
                                                {{ $post->commentCount() }} Comments
                                            </button>
                                            <button class="btn btn-link text-body p-0 fs-10 me-2 fw-bolder"
                                                type="button">
                                                <span class="fa-solid fa-share me-1"></span>
                                                56 Shares
                                            </button>
                                        </div>
                                    </div>
                                    <div class="bg-body-highlight border-top border-translucent p-3 p-sm-4">
                                        {{-- @php
                                            $limitedComments = $post->comments->slice(0, 3);
                                        @endphp --}}

                                        @foreach ($post->comments as $comment)
                                            <div class="d-flex align-items-start">
                                                <a href="{{ route('profile.show', $comment->user->username) }}">
                                                    <div class="avatar avatar-m  me-2">
                                                        <img class="rounded-circle "
                                                            src="{{ asset('storage/' . $comment->user->profile_picture) ?? asset('storage/profile_pictures/default-png') }}"
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
                                            <a href="{{ route('profile.show', $user->username) }}">
                                                <div class="avatar avatar-m  me-2">
                                                    <img class="rounded-circle "
                                                        src="{{ asset('storage/' . $user->profile_picture) ?? asset('storage/profile_pictures/default.png') }}"
                                                        alt="" />
                                                </div>
                                            </a>
                                            <div class="flex-1">
                                                <form action="{{ route('comments.store', $post->id) }}"
                                                    method="POST" onsubmit="submitForm(event)">
                                                    @csrf
                                                    <input type="hidden" name="post_id"
                                                        value="{{ $post->id }}">

                                                    <textarea id="promptTextarea" class="form-control border-translucent border-0 flex-1 fs-8" rows="1"
                                                        placeholder="Comment as {{ $user->firstname }} {{ $user->lastname }}" name="content" oninput="autoResize(this)"
                                                        onkeydown="handleKey(event)"></textarea>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="text-center"><a class="btn btn-link fs-8 p-0" href="#!">Load more</a></div>
                </div>

                <div class="col-md-4 col-xl-3 d-none d-lg-block right-column ms-5">
                    <div class="card mb-5 bg-transparent border-0">
                        <div class="card-header border-0 fw-semibold">
                            {{ __('Sponsored') }}
                        </div>
                        <div class="card-body pt-0 mt-0 top-0">
                            {{ __('Something in here') }}
                        </div>
                    </div>
                    <div class="card mb-5 bg-transparent border-0">
                        <div class="card-header border-0 fw-semibold">
                            {{ __('Friend requests') }}
                        </div>
                        <div class="card-body pt-0 mt-0 top-0">
                            {{ __('Something in here') }}
                        </div>
                    </div>
                    <div class="card mb-5 bg-transparent border-0">
                        <div class="card-header border-0 fw-semibold">
                            {{ __('Birthdays') }}
                        </div>
                        <div class="card-body pt-0 mt-0 top-0">
                            {{ __('Something in here') }}
                        </div>
                    </div>
                    <div class="card mb-5 bg-transparent border-0">
                        <div class="card-header border-0 fw-semibold">
                            {{ __('Contacts') }}
                        </div>
                        <div class="card-body pt-0 mt-0 top-0">
                            {{ __('Something in here') }}
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

    <script>
        function confirmDelete(postId) {
            Swal.fire({
                title: 'Are you sure?',
                text: "This action cannot be undone!",
                icon: 'warning',
                showCancelButton: true,
                reverseButtons: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('deletePostForm-' + postId)
                        .submit(); // Submit the form programmatically
                }
            });
        }

        function handleFiles(files) {
            const preview = document.getElementById('preview');
            preview.innerHTML = ''; // Clear previous previews

            if (files.length > 0) {
                preview.classList.remove('d-none'); // Show the preview div
            } else {
                preview.classList.add('d-none'); // Hide the preview div if no files
            }

            for (const file of files) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    const mediaContainer = document.createElement('div');
                    mediaContainer.style.position = 'relative';
                    mediaContainer.style.marginRight = '10px';
                    mediaContainer.style.width = '70vw'; // Set a width for the preview
                    mediaContainer.style.height = '60vh'; // Set a height for the preview
                    mediaContainer.style.overflow = 'hidden'; // Hide overflow

                    const mediaElement = document.createElement(file.type.startsWith('image/') ? 'img' : 'video');
                    mediaElement.src = e.target.result;
                    mediaElement.style.width = '100%'; // Make media fill the container
                    mediaElement.style.height = '100%'; // Make media fill the container
                    mediaElement.style.objectFit = 'cover'; // Crop the media if necessary
                    mediaContainer.appendChild(mediaElement);

                    const removeButton = document.createElement('button');
                    removeButton.innerHTML = 'X';
                    removeButton.style.position = 'absolute';
                    removeButton.style.top = '5px';
                    removeButton.style.right = '5px';
                    removeButton.style.backgroundColor = 'red';
                    removeButton.style.color = 'white';
                    removeButton.style.border = 'none';
                    removeButton.style.cursor = 'pointer';
                    removeButton.onclick = () => {
                        preview.removeChild(mediaContainer); // Remove the preview
                        resetFileInput(); // Reset the file input to allow re-selection
                    };

                    mediaContainer.appendChild(removeButton);
                    preview.appendChild(mediaContainer);
                };
                reader.readAsDataURL(file);
            }
        }

        function resetFileInput() {
            const fileInput = document.getElementById('post_media');
            fileInput.value = ''; // Reset the file input value
        }

        $(document).ready(function() {
            $('.toggle-like').click(function() {
                const postId = $(this).data('post-id');
                const likeCountElement = $(this).find('.like-count');

                $.ajax({
                    url: '/posts/' + postId + '/like', // Route to your like controller
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}' // CSRF token for Laravel
                    },
                    success: function(response) {
                        if (response.liked) {
                            likeCountElement.text(response.likeCount);
                            $(this).text("Liked");
                            $(this).addClass(
                                'text-body'); // Optional: add a class to change style
                        } else {
                            likeCountElement.text(response.likeCount);
                            $(this).text("Like");
                            $(this).removeClass('text-body'); // Optional: remove class
                        }
                    }.bind(this), // Bind 'this' to maintain the context
                    error: function() {
                        alert('An error occurred while liking the post.');
                    }
                });
            });
        });

        function autoResize(textarea) {
            textarea.style.height = 'auto';
            textarea.style.height = textarea.scrollHeight + 'px';
        }

        // function handleKey(event) {
        //     if (event.key === 'Enter') {
        //         if (!event.shiftKey) {
        //             event.preventDefault(); // Prevent default behavior
        //             submitForm(event); // Call submit function
        //         }
        //     }
        // }
        function handleKey(event) {
            if (event.key === 'Enter') {
                if (!event.shiftKey) {
                    event.preventDefault(); // Prevent default behavior
                    submitForm(event); // Call the submit function
                }
            }
        }

        function submitForm(event) {
            event.preventDefault(); // Prevent default form behavior
            const textarea = document.getElementById('promptTextarea');
            const value = textarea.value; // Get the value

            if (value.trim()) { // Check if the value is not just whitespace
                // Submit the form programmatically
                event.target.submit();
            } else {
                console.log('Textarea is empty.'); // Log if empty
            }
        }
    </script>
</x-app-layout>
