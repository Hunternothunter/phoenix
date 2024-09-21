<x-app-layout>
    <style>
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
    </style>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="container-fluid p-0">
        {{-- <h1 class="h3 mb-3">Profile</h1> --}}

        <div class="row">
            <div class="col-md-4 col-xl-3">
                <div class="card mb-3">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">Profile Details</h5>
                        @include('modals.update-profile')

                        <a class="nav-link d-flex align-items-center" data-bs-toggle="dropdown">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width="20"
                                height="20"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                <path
                                    d="M8 256a56 56 0 1 1 112 0A56 56 0 1 1 8 256zm160 0a56 56 0 1 1 112 0 56 56 0 1 1 -112 0zm216-56a56 56 0 1 1 0 112 56 56 0 1 1 0-112z" />
                            </svg>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a class="dropdown-item btn btn-lg w-100 fw-bold" data-bs-toggle="modal"
                                data-bs-target="#whats-on-your-mind">
                                <span class="ml-5">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="15"
                                        height="15"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
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
                                            {{ Auth::user()->isFollowing($user->id) ? 'Following' : 'Follow' }}
                                        </button>
                                    </form>
                                    <a class="btn btn-light btn-lg" href="{{ route('messages.create', $user->id) }}">
                                        {{-- <span data-lucide="message-square"></span> --}}
                                        Message
                                    </a>
                                </div>
                            @endif
                        @endauth

                    </div>
                    <hr class="my-0" />
                    {{-- <div class="card-body">
                        <h5 class="h6 card-title">Skills</h5>
                        <a href="#" class="badge badge-subtle-primary me-1 my-1">HTML</a>
                        <a href="#" class="badge badge-subtle-primary me-1 my-1">JavaScript</a>
                        <a href="#" class="badge badge-subtle-primary me-1 my-1">Sass</a>
                        <a href="#" class="badge badge-subtle-primary me-1 my-1">Angular</a>
                        <a href="#" class="badge badge-subtle-primary me-1 my-1">Vue</a>
                        <a href="#" class="badge badge-subtle-primary me-1 my-1">React</a>
                        <a href="#" class="badge badge-subtle-primary me-1 my-1">Redux</a>
                        <a href="#" class="badge badge-subtle-primary me-1 my-1">UI</a>
                        <a href="#" class="badge badge-subtle-primary me-1 my-1">UX</a>
                    </div> --}}
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

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if (session('message'))
                Swal.fire({
                    title: 'Success!',
                    text: '{{ session('message') }}',
                    icon: 'success',
                    timer: 2000
                });
            @endif

            document.getElementById('follow-form').addEventListener('submit', function(event) {
                event.preventDefault();
                let form = this;
                let button = document.getElementById('follow-button');

                fetch(form.action, {
                        method: 'POST',
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                .getAttribute('content'),
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({}),
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === 'followed') {
                            button.textContent = 'Following';
                        } else if (data.status === 'unfollowed') {
                            button.textContent = 'Follow';
                        }
                    })
                    .catch(error => console.error('Error:', error));
            });
        });
    </script>
</x-app-layout>
