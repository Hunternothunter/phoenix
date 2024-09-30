<x-app-layout>
    {{-- <style>
        .image-container {
            width: 120px;
            height: 110px;
            border-radius: 50%;
            overflow: hidden;
            background-color: #f0f0f0;
            border: 1px solid #ddd;
            position: relative;
            margin: 0 auto;
        }

        .image-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            position: absolute;
            top: 0;
            left: 0;
        }

        #upload-button {
            display: inline-flex;
            align-items: center;
            padding: 0.5rem 1rem;
        }
    </style> --}}
    {{-- <meta name="csrf-token" content="{{ csrf_token() }}"> --}}

    {{-- <div class="container-fluid p-0">

        <div class="row">
            <div class="col-md-4 col-xl-3">
                <div class="card mb-3">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">Profile Details</h5>
                        @include('modals.update-profile')

                        @if (Auth::check() && Auth::user()->id === $user->id && Auth::user())
                            <a class="nav-link d-flex align-items-center" data-bs-toggle="dropdown">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width="20"
                                    height="20">
                                    <path
                                        d="M8 256a56 56 0 1 1 112 0A56 56 0 1 1 8 256zm160 0a56 56 0 1 1 112 0 56 56 0 1 1 -112 0zm216-56a56 56 0 1 1 0 112 56 56 0 1 1 0-112z" />
                                </svg>
                            </a>
                        @endif

                        <div class="dropdown-menu dropdown-menu-end">
                            <a class="dropdown-item btn btn-lg w-100 fw-bold" data-bs-toggle="modal"
                                data-bs-target="#whats-on-your-mind">
                                <span class="ml-5">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="15"
                                        height="15">
                                        <path
                                            d="M362.7 19.3L314.3 67.7 444.3 197.7l48.4-48.4c25-25 25-65.5 0-90.5L453.3 19.3c-25-25-65.5-25-90.5 0zm-71 71L58.6 323.5c-10.4 10.4-18 23.3-22.2 37.4L1 481.2C-1.5 489.7 .8 498.8 7 505s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L421.7 220.3 291.7 90.3z" />
                                    </svg>
                                </span>
                                Edit profile
                            </a>
                        </div>
                    </div>

                    <div class="card-body text-center">
                        <img src="{{ $user->profile_picture ? asset('storage/' . $user->profile_picture) : asset('storage/profile_pictures/default-user.png') }}"
                            alt="{{ $user->firstname }}" class="img-fluid rounded-circle mb-2" width="128"
                            height="128" />
                        <h5 class="card-title mb-0">{{ $user->firstname . ' ' . $user->lastname }}</h5>
                        <div class="text-muted mb-2">{{ $user->email }}</div>
                        <div class="text-muted mb-2">Joined: {{ $user->created_at->format('F d, Y') }}</div>

                        @auth
                            @if (!(Auth::check() && Auth::user()->id === $user->id) && Auth::user())
                                <div class="d-flex inline-flex align-item-center justify-content-center gap-2">
                                    <form id="follow-form" action="{{ route('users.followToggle', $user->id) }}"
                                        method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-primary btn-lg" id="follow-button">
                                            @if ($user->isFollowing(Auth::id())) Following @else Follow @endif
                                        </button>
                                    </form>
                                    <a class="btn btn-light btn-lg" href="{{ route('messages.create', $user->id) }}">
                                        Message
                                    </a>
                                </div>
                            @endif
                        @endauth

                    </div>
                    <hr class="my-0" />
                    <div class="card-body">
                        <h5 class="h6 card-title">Bio</h5>
                        <p class="me-1 my-1 text-center" name="bio">
                            {{ $user->bio ? $user->bio : 'No bio available' }}
                        </p>
                    </div>
                    <hr class="my-0" />
                    <div class="card-body">
                        <h5 class="h6 card-title">About</h5>
                        <ul class="list-unstyled mb-0">
                            <li class="mb-1"><span data-lucide="home" class="lucide-sm me-1"></span> Lives in <a
                                    href="#">San Francisco, SA</a></li>

                            <li class="mb-1"><span data-lucide="briefcase" class="lucide-sm me-1"></span> Works at <a
                                    href="#">GitHub</a></li>
                            <li class="mb-1"><span data-lucide="map-pin" class="lucide-sm me-1"></span> From <a
                                    href="#">Boston</a></li>
                        </ul>
                    </div>
                    <hr class="my-0" />
                    <div class="card-body">
                        <h5 class="h6 card-title">Elsewhere</h5>
                        <ul class="list-unstyled mb-0">
                            <li class="mb-1"><span class="fas fa-globe fa-fw me-1"></span> <a
                                    href="#">staciehall.co</a></li>
                            <li class="mb-1"><span class="fab fa-twitter fa-fw me-1"></span> <a
                                    href="#">Twitter</a></li>
                            <li class="mb-1"><span class="fab fa-facebook fa-fw me-1"></span> <a
                                    href="#">Facebook</a></li>
                            <li class="mb-1"><span class="fab fa-instagram fa-fw me-1"></span> <a
                                    href="#">Instagram</a></li>
                            <li class="mb-1"><span class="fab fa-linkedin fa-fw me-1"></span> <a
                                    href="#">LinkedIn</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-md-8 col-xl-9">
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

                        <div class="d-flex align-items-start">
                            <img src="img/avatars/avatar-5.jpg" width="36" height="36"
                                class="rounded-circle me-2" alt="Ashley Briggs">
                            <div class="flex-grow-1">
                                <small class="float-end">5m ago</small>
                                <strong>Ashley Briggs</strong> started following <strong>Stacie Hall</strong><br />
                                <small class="text-muted">Today 7:51 pm</small><br />

                            </div>
                        </div>

                        <hr />
                        <div class="d-flex align-items-start">
                            <img src="img/avatars/avatar.jpg" width="36" height="36"
                                class="rounded-circle me-2" alt="Chris Wood">
                            <div class="flex-grow-1">
                                <small class="float-end">30m ago</small>
                                <strong>Chris Wood</strong> posted something on <strong>Stacie Hall</strong>'s
                                timeline<br />
                                <small class="text-muted">Today 7:21 pm</small>

                                <div class="border text-sm text-muted p-2 mt-1">
                                    Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper
                                    libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus
                                    pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec
                                    vitae sapien ut libero venenatis faucibus. Nullam quis ante.
                                </div>

                                <a href="#" class="btn btn-sm btn-danger mt-1"><i class="lucide-sm"
                                        data-lucide="heart"></i> Like</a>
                            </div>
                        </div>

                        <hr />
                        <div class="d-flex align-items-start">
                            <img src="img/avatars/avatar-4.jpg" width="36" height="36"
                                class="rounded-circle me-2" alt="Stacie Hall">
                            <div class="flex-grow-1">
                                <small class="float-end">1h ago</small>
                                <strong>Stacie Hall</strong> posted a new blog<br />

                                <small class="text-muted">Today 6:35 pm</small>
                            </div>
                        </div>

                        <hr />
                        <div class="d-flex align-items-start">
                            <img src="img/avatars/avatar-2.jpg" width="36" height="36"
                                class="rounded-circle me-2" alt="Carl Jenkins">
                            <div class="flex-grow-1">
                                <small class="float-end">3h ago</small>
                                <strong>Carl Jenkins</strong> posted two photos on <strong>Stacie Hall</strong>'s
                                timeline<br />
                                <small class="text-muted">Today 5:12 pm</small>

                                <div class="row g-0 mt-1">
                                    <div class="col-6 col-md-4 col-lg-4 col-xl-3">
                                        <img src="img/photos/unsplash-1.jpg" class="img-fluid pe-2" alt="Unsplash">
                                    </div>
                                    <div class="col-6 col-md-4 col-lg-4 col-xl-3">
                                        <img src="img/photos/unsplash-2.jpg" class="img-fluid pe-2" alt="Unsplash">
                                    </div>
                                </div>

                                <a href="#" class="btn btn-sm btn-danger mt-1"><i class="lucide-sm"
                                        data-lucide="heart"></i> Like</a>
                            </div>
                        </div>

                        <hr />
                        <div class="d-flex align-items-start">
                            <img src="img/avatars/avatar-2.jpg" width="36" height="36"
                                class="rounded-circle me-2" alt="Carl Jenkins">
                            <div class="flex-grow-1">
                                <small class="float-end">1d ago</small>
                                <strong>Carl Jenkins</strong> started following <strong>Stacie Hall</strong><br />
                                <small class="text-muted">Yesterday 3:12 pm</small>

                                <div class="d-flex align-items-start mt-1">
                                    <a class="pe-3" href="#">
                                        <img src="img/avatars/avatar-4.jpg" width="36" height="36"
                                            class="rounded-circle me-2" alt="Stacie Hall">
                                    </a>
                                    <div class="flex-grow-1">
                                        <div class="border text-sm text-muted p-2 mt-1">
                                            Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas
                                            nec odio et ante tincidunt tempus.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr />
                        <div class="d-flex align-items-start">
                            <img src="img/avatars/avatar-4.jpg" width="36" height="36"
                                class="rounded-circle me-2" alt="Stacie Hall">
                            <div class="flex-grow-1">
                                <small class="float-end">1d ago</small>
                                <strong>Stacie Hall</strong> posted a new blog<br />
                                <small class="text-muted">Yesterday 2:43 pm</small>
                            </div>
                        </div>

                        <hr />
                        <div class="d-flex align-items-start">
                            <img src="img/avatars/avatar.jpg" width="36" height="36"
                                class="rounded-circle me-2" alt="Chris Wood">
                            <div class="flex-grow-1">
                                <small class="float-end">1d ago</small>
                                <strong>Chris Wood</strong> started following <strong>Stacie Hall</strong><br />
                                <small class="text-muted">Yesterdag 1:51 pm</small>
                            </div>
                        </div>

                        <hr />
                        <div class="d-grid">
                            <a href="#" class="btn btn-primary">Load more</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div> --}}

    {{-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if (session('message'))
                Swal.fire({
                    title: 'Success!',
                    text: '{{ session('message') }}',
                    icon: 'success',
                    timer: 2000
                });
            @endif

            // document.getElementById('follow-form').addEventListener('submit', function(event) {
            //     event.preventDefault();
            //     let form = this;
            //     let button = document.getElementById('follow-button');

            //     fetch(form.action, {
            //             method: 'POST',
            //             headers: {
            //                 'X-Requested-With': 'XMLHttpRequest',
            //                 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
            //                     .getAttribute('content'),
            //                 'Content-Type': 'application/json'
            //             },
            //             body: JSON.stringify({}),
            //         })
            //         .then(response => response.json())
            //         .then(data => {
            //             if (data.status === 'followed') {
            //                 button.textContent = 'Following';
            //             } else if (data.status === 'unfollowed') {
            //                 button.textContent = 'Follow';
            //             }
            //         })
            //         .catch(error => console.error('Error:', error))
            // });
        });
    </script> --}}

    {{-- @vite(['resources/css/theme.min.css']) --}}

    <div class="content">
        <div class="pb-9">
            <div class="card">
                <div class="card-header d-flex justify-content-center align-items-end position-relative mb-7 mb-xxl-0"
                    style="min-height: 214px;">
                    <div class="hover-actions-trigger position-static">
                        <div class="bg-holder rounded-top"
                            style="background-image:url('{{ $user->profile_picture ? asset('storage/' . $user->profile_picture) : asset('storage/profile_pictures/default-user.png') }}">
                        </div>
                        <input class="d-none" id="upload-cover-image" type="file" />
                        <label class="cover-image-file-input" for="upload-cover-image"></label>
                        <div class="hover-actions end-0 bottom-0 pe-1 pb-2 text-white">
                            <span class="fa-solid fa-camera me-2 overlay-icon"></span>
                        </div>
                        <!--/.bg-holder-->
                    </div>
                    <input class="d-none" id="upload-porfile-picture" type="file" />
                    <div class="hoverbox feed-profile" style="width: 150px; height: 150px;">
                        <div class="hoverbox-content rounded-circle d-flex flex-center z-1"
                            style="--phoenix-bg-opacity: .56;">
                            <span class="fa-solid fa-camera fs-3 text-secondary-light"></span>
                        </div>
                        <div
                            class="position-relative bg-body-quaternary rounded-circle cursor-pointer d-flex flex-center mb-xxl-7">
                            <div class="avatar avatar-5xl">
                                <img class="rounded-circle rounded-circle img-thumbnail shadow-sm border-0"
                                    src="{{ asset('storage/' . $user->profile_picture ?? 'profile_pictures/default-user.png') }}"
                                    alt="" />
                            </div>
                            <label class="w-100 h-100 position-absolute z-1" for="upload-porfile-picture"></label>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row justify-content-xl-between">
                        <div class="col-auto">
                            <div class="d-flex flex-wrap mb-3 align-items-center">
                                <h2 class="me-2">{{ $user->firstname }} {{ $user->lastname }}</h2>
                                <span class="fw-semibold fs-7 text-body-emphasis">u/{{ $user->username }}</span>
                            </div>
                            <div class="mb-5">
                                <div class="d-md-flex align-items-center">
                                    <div class="d-flex align-items-center">
                                        <span
                                            class="fa-solid fa-user-group fs-9 text-body-tertiary me-2 me-lg-1 me-xl-2"></span>
                                        <a class="text-body-emphasis" href="#!">
                                            <span
                                                class="fs-7 fw-bold text-body-tertiary text-opacity-85 text-body-emphasis-hover">
                                                {{ $user->followersCount() }}
                                                <span class="fw-semibold ms-1 me-4">
                                                    Followers
                                                </span>
                                            </span>
                                        </a>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <span
                                            class="fa-solid fa-user-check fs-9 text-body-tertiary me-2 me-lg-1 me-xl-2"></span>
                                        <a class="text-body-emphasis" href="#!">
                                            <span
                                                class="fs-7 fw-bold text-body-tertiary text-opacity-85 text-body-emphasis-hover">
                                                {{ $user->followingCount() }}
                                                <span class="fw-semibold ms-1 me-4">
                                                    Following
                                                </span>
                                            </span>
                                        </a>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <span
                                            class="fa-solid fa-location-dot fs-9 text-body-tertiary me-2 me-lg-1 me-xl-2"></span>
                                        <a class="text-body-emphasis" href="#!">
                                            <span
                                                class="fs-7 fw-semibold text-body-tertiary text-opacity-85 text-body-emphasis-hover">
                                                Quezon City
                                            </span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <p class="fs-6 text-body-secondary">I love you babyyy</p>
                        </div>
                        <div class="col-auto">
                            <div class="row g-2">
                                <div class="col-auto order-xxl-2">
                                    <button class="btn btn-primary lh-1">
                                        <span class="fa-solid fa-user-plus me-2"></span>
                                        Follow Request
                                    </button>
                                </div>
                                <div class="col-auto order-xxl-1">
                                    <a href="{{ route('messages.create', $user->id) }}"
                                        class="btn btn-phoenix-primary lh-1">
                                        <span class="fa-solid fa-message me-2"></span>
                                        Send Message
                                    </a>
                                </div>
                                <div class="col-auto">
                                    <div class="position-static">
                                        <button class="btn btn-phoenix-secondary lh-1" data-bs-toggle="dropdown"
                                            data-boundary="window" aria-haspopup="true" aria-expanded="false"
                                            data-bs-reference="parent">
                                            <span class="fa-solid fa-chevron-down me-2"></span>
                                            More
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end py-2">
                                            <a class="dropdown-item d-xl-none" href="#!">
                                                <span class="fa-solid fa-user-group text-body-secondary me-2"></span>
                                                <span>Followers</span>
                                            </a>
                                            <a class="dropdown-item d-xl-none" href="#!">
                                                <span class="fa-solid fa-users text-body-secondary me-2"></span>
                                                <span>Communities</span>
                                            </a>
                                            <a class="dropdown-item d-xl-none" href="#!">
                                                <span class="fa-solid fa-photo-film text-body-secondary me-2"></span>
                                                <span>Media Files</span>
                                            </a>
                                            <a class="dropdown-item d-xl-none" href="#!">
                                                <span
                                                    class="fa-solid fa-calendar-days fs-8 text-body-secondary me-2"></span>
                                                <span> Events</span>
                                            </a>
                                            <a class="dropdown-item d-xl-none" href="#!">
                                                <span class="fa-solid fa-dice text-body-secondary me-2"></span>
                                                <span>Games</span>
                                            </a>
                                            <a class="dropdown-item d-xl-none" href="#!">
                                                <span class="fa-solid fa-user-gear text-body-secondary me-2"></span>
                                                <span>Settings</span>
                                            </a>
                                            <a class="dropdown-item" href="#!">
                                                <span class="fa-solid fa-bell-slash text-body-secondary me-2"></span>
                                                <span>Mute Conversation</span>
                                            </a>
                                            <a class="dropdown-item" href="#!">
                                                <span class="fa-solid fa-gear text-body-secondary me-2"></span>
                                                <span>Manage Settings</span>
                                            </a>
                                            <a class="dropdown-item" href="#!">
                                                <span
                                                    class="fa-solid fa-hand-holding-heart text-body-secondary me-2"></span>
                                                <span>Get help</span>
                                            </a>
                                            <a class="dropdown-item" href="#!">
                                                <span class="fa-solid fa-flag text-body-secondary me-2"></span>
                                                <span>Report Account</span>
                                            </a>
                                            <a class="dropdown-item" href="#!">
                                                <span class="fa-solid fa-ban text-body-secondary me-2"></span>
                                                <span>Block Account</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="row gy-3 gx-5 gx-xxl-6 gap-5">
                <div class="col-xl-4 d-none d-xl-block">
                    <div class="mb-8">
                        <div class="row g-0">
                            <div class="col-6 border-1 border-bottom border-translucent border-end py-2">
                                <a class="btn btn-link ps-2 fs-8 text-body-secondary text-primary-hover fw-semibold d-flex flex-column d-xxl-inline-block"
                                    href="#!">
                                    <span class="fa-solid fa-user-group me-2 mb-2 mb-xxl-0"></span>
                                    Followers
                                </a>
                            </div>
                            <div class="col-6 border-1 border-bottom border-translucent py-2">
                                <a class="btn btn-link fs-8 text-body-secondary text-primary-hover fw-semibold d-flex flex-column d-xxl-inline-block"
                                    href="#!">
                                    <span class="fa-solid fa-users me-2 mb-2 mb-xxl-0"></span>
                                    Communities
                                </a>
                            </div>
                            <div class="col-6 border-1 border-bottom border-translucent border-end py-2">
                                <a class="btn btn-link ps-2 fs-8 text-body-secondary text-primary-hover fw-semibold d-flex flex-column d-xxl-inline-block"
                                    href="#!">
                                    <span class="fa-solid fa-photo-film me-2 mb-2 mb-xxl-0"></span>
                                    Media Files
                                </a>
                            </div>
                            <div class="col-6 border-1 border-bottom border-translucent py-2">
                                <a class="btn btn-link fs-8 text-body-secondary text-primary-hover fw-semibold d-flex flex-column d-xxl-inline-block"
                                    href="#!">
                                    <span class="fa-solid fa-calendar-days me-2 mb-2 mb-xxl-0"></span>
                                    Events
                                </a>
                            </div>
                            <div class="col-6 border-1 border-end border-translucent py-2">
                                <a class="btn btn-link ps-2 fs-8 text-body-secondary text-primary-hover fw-semibold d-flex flex-column d-xxl-inline-block"
                                    href="#!">
                                    <span class="fa-solid fa-dice me-2 mb-2 mb-xxl-0"></span>
                                    Games
                                </a>
                            </div>
                            <div class="col-6 border-1 py-2">
                                <a class="btn btn-link fs-8 text-body-secondary text-primary-hover fw-semibold d-flex flex-column d-xxl-inline-block"
                                    href="{{ route('profile.edit', $user->id) }}">
                                    <span class="fa-solid fa-user-gear me-2 mb-2 mb-xxl-0"></span>
                                    Settings
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="mb-8">
                        <div class="d-flex pb-4 align-items-end">
                            <h4 class="flex-1 mb-0">Photos</h4>
                            <a class="fw-bold fs-9 me-4" href="#!">Albums</a>
                            <a class="fw-bold fs-9" href="#!">See all</a>
                        </div>
                        <div class="row g-3">
                            <div class="col-4">
                                <a href="../../assets/img/gallery/11.png" data-gallery="gallery-photos">
                                    <img class="w-100 rounded-3" src="../../assets/img/gallery/11.png"
                                        alt="" />
                                </a>
                            </div>
                            <div class="col-4">
                                <a href="../../assets/img/gallery/12.png" data-gallery="gallery-photos">
                                    <img class="w-100 rounded-3" src="../../assets/img/gallery/12.png"
                                        alt="" />
                                </a>
                            </div>
                            <div class="col-4">
                                <a href="../../assets/img/gallery/13.png" data-gallery="gallery-photos">
                                    <img class="w-100 rounded-3" src="../../assets/img/gallery/13.png"
                                        alt="" />
                                </a>
                            </div>
                            <div class="col-4">
                                <a href="../../assets/img/gallery/14.png" data-gallery="gallery-photos">
                                    <img class="w-100 rounded-3" src="../../assets/img/gallery/14.png"
                                        alt="" />
                                </a>
                            </div>
                            <div class="col-4">
                                <a href="../../assets/img/gallery/15.png" data-gallery="gallery-photos">
                                    <img class="w-100 rounded-3" src="../../assets/img/gallery/15.png"
                                        alt="" />
                                </a>
                            </div>
                            <div class="col-4">
                                <a href="../../assets/img/gallery/16.png" data-gallery="gallery-photos">
                                    <img class="w-100 rounded-3" src="../../assets/img/gallery/16.png"
                                        alt="" />
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex pb-4 align-items-end border-bottom border-translucent border-dashed">
                        <h4 class="flex-1 mb-0">You and Erza</h4>
                        <a class="fw-bold fs-9" href="#!">
                            See details
                        </a>
                    </div>
                    <div class="row g-0 mb-5 mb-lg-0">
                        <div class="col-12 border-1 border-bottom border-translucent py-2">
                            <a class="btn btn-link px-0 fs-8 text-body-secondary text-primary-hover fw-semibold d-flex"
                                href="#!">
                                <span class="fa-solid fa-user-group me-2 mb-2 mb-xxl-0"></span>
                                432 Common Followers
                            </a>
                        </div>
                        <div class="col-12 border-1 border-bottom border-translucent py-2">
                            <a class="btn btn-link px-0 fs-8 text-body-secondary text-primary-hover fw-semibold d-flex"
                                href="#!">
                                <span class="fa-solid fa-users me-2 mb-2 mb-xxl-0"></span>
                                21 Communities
                            </a>
                        </div>
                        <div class="col-12 border-1 border-bottom border-translucent py-2">
                            <a class="btn btn-link px-0 fs-8 text-body-secondary text-primary-hover fw-semibold d-flex"
                                href="#!">
                                <span class="fa-solid fa-tags me-2 mb-2 mb-xxl-0"></span>
                                12 Tagged Images
                            </a>
                        </div>
                        <div class="col-12 border-1 border-bottom border-translucent py-2">
                            <a class="btn btn-link px-0 fs-8 text-body-secondary text-primary-hover fw-semibold d-flex"
                                href="#!">
                                <span class="fa-solid fa-calendar-days me-2 mb-2 mb-xxl-0"></span>
                                3 Common Events
                            </a>
                        </div>
                        <div class="col-12 border-1 border-bottom border-translucent py-2">
                            <a
                                class="btn btn-link px-0 fs-8 text-body-secondary text-primary-hover fw-semibold d-flex"href="#!">
                                <span class="fa-solid fa-location-dot me-2 mb-2 mb-xxl-0"></span>
                                45 Common Check-ins
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-5 col-xl-6">
                    <div class="mb-9">
                        @foreach ($posts as $post)
                            <div class="mb-5">
                                <div class="card mb-4">
                                    <div class="card-body p-3 p-sm-4">
                                        <div class="border-translucent mb-3">
                                            <div class="d-flex align-items-center mb-3">
                                                <a href="../../apps/social/profile.html">
                                                    <div class="avatar avatar-xl  me-2">
                                                        <img class="rounded-circle "
                                                            src="{{ asset('storage/' . $post->user->profile_picture) }}"
                                                            alt="" />
                                                    </div>
                                                </a>
                                                <div class="flex-1">
                                                    <a class="fw-bold mb-0 text-body-emphasis"
                                                        href="../../apps/social/profile.html">
                                                        {{ $post->user->firstname }}
                                                        {{ $post->user->lastname }}
                                                    </a>
                                                    <p
                                                        class="fs-10 mb-0 text-body-tertiary text-opacity-85 fw-semibold">
                                                        {{ customTimeDiff($post->created_at) }}
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
                                                        <a class="dropdown-item text-danger" href="{{ route('posts.destroy', $post->id) }}">Delete</a>
                                                        <a class="dropdown-item" href="#!">Download</a>
                                                        <a class="dropdown-item" href="#!">Report abuse</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <p class="text-body-secondary">{{ $post->content }}</p>
                                            <div class="row g-1 mb-5">
                                                <div class="col-3">
                                                    @if (in_array(pathinfo($post->post_media, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif']))
                                                        <a href="{{ route('posts.show_images', $post->id) }}" data-gallery="gallery-posts-0">
                                                            <img class="rounded h-100 w-100"
                                                                src="{{ asset('storage/' . $post->post_media) }}" alt="..." />
                                                        </a>
                                                    @elseif (in_array(pathinfo($post->post_media, PATHINFO_EXTENSION), ['mp4', 'mov', 'avi']))
                                                        <a href="{{ route('posts.show_videos', $post->id) }}"
                                                            type="button" class="decoration-none border-0">
                                                            <video class="img-fluid pe-1" width="420" height="240" controls>
                                                                <source src="{{ asset('storage/' . $post->post_media) }}" type="video/mp4">
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
                
            </div>

            {{-- <div class="navbar-bottom d-xl-none">
                <div class="nav"><a class="nav-link" aria-current="page" href="../../apps/social/feed.html"><span
                            class="fa-solid fa-home nav-icon"></span><span class="nav-label">Home</span></a><a
                        class="nav-link active" href="../../apps/social/profile.html"><span
                            class="fa-solid fa-user nav-icon"></span><span class="nav-label">Profile</span></a><a
                        class="nav-link" href="#!"><span class="fa-solid fa-image nav-icon"></span><span
                            class="nav-label">Photos</span></a><a class="nav-link" href="../../apps/chat.html"><span
                            class="fa-solid fa-message nav-icon"></span><span class="nav-label">Messages</span></a><a
                        class="nav-link" href="../../apps/events/event-detail.html"><span
                            class="fa-solid fa-calendar-days nav-icon"></span><span class="nav-label">Events</span></a>
                </div>
            </div> --}}
        </div>
    </div>

</x-app-layout>
