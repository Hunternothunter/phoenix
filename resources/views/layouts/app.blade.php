<!DOCTYPE html>

<html id="mainHtml" lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-bs-theme="light" data-layout="fluid"
    data-sidebar-theme="light" data-sidebar-position="left" data-sidebar-behavior="sticky">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Responsive Bootstrap 5 Admin &amp; Dashboard Template">
    <meta name="author" content="Bootlab">

    <title>Huntergram</title>

    <link rel="shortcut icon" href="img/favicon.ico">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <link href="css/app.css" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-Q3ZYEKLQ68');
    </script>
</head>
<style>
    .nav-btn {
        border: none;
        width: 100px;
        padding: 1.3rem;
    }

    .position-relative {
        position: relative;
    }

    .nav-btn:hover {
        background-color: rgba(129, 117, 117, 0.041);
    }

    .nav-btn.active .border-bottom {
        display: block;
    }

    .border-bottom {
        display: none;
    }

    .rounded-left {
        border-top-left-radius: 1rem;
        border-bottom-left-radius: 1rem;
    }

    .rounded-left::placeholder {
        font-size: 0.9rem;
    }

    .rounded-right {
        border-top-right-radius: 1rem;
        border-bottom-right-radius: 1rem;
    }

    .iconBtn {
        cursor: pointer;
        border-radius: 50%;
        width: 35px;
        height: 35px;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 0;
    }

    .iconBtn:hover {
        background-color: #eeeeee;
    }

    /* #loading {
        position: fixed;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background: rgba(255, 255, 255, 0.8);
        z-index: 9999;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .spinner {
        border: 8px solid #f3f3f3;
        border-top: 8px solid #3498db;
        border-radius: 50%;
        width: 60px;
        height: 60px;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    } */
</style>

<body>
    <div class="wrapper">

        {{-- <!-- Loading Spinner -->
        <div id="loading" style="display:none;">
            <div class="spinner"></div>
        </div> --}}

        @if (Auth::user())
            {{-- <nav id="sidebar" class="sidebar">
                <div class="sidebar-content js-simplebar">
                    <a class='sidebar-brand' href='{{ route('home') }}'>
                        <div class="text-center gap-2">
                            <div id="apptitle">
                                {{ __('Huntergram') }}
                            </div>
                        </div>
                    </a>

                    <ul class="sidebar-nav">
                        <li class="sidebar-header">
                            Navigation
                        </li>
                        <li class="sidebar-item">
                            <a href="{{ route('home') }}" class="sidebar-link">
                                <i class="align-middle" data-lucide="home"></i> <span class="align-middle">Home</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="#" class="sidebar-link">
                                <i class="align-middle" data-lucide="search"></i> <span
                                    class="align-middle">Search</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{ route('profile.show', Auth::user()->username) }}" class="sidebar-link">
                                <i class="align-middle" data-lucide="user"></i> <span
                                    class="align-middle">Profile</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{ route('posts.index') }}" class="sidebar-link">
                                <i class="align-middle" data-lucide="image"></i> <span class="align-middle">Posts</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{ route('messages.index') }}" class="sidebar-link">
                                <i class="align-middle" data-lucide="message-circle"></i> <span
                                    class="align-middle">Messages</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="#" class="sidebar-link">
                                <i class="align-middle" data-lucide="settings"></i> <span
                                    class="align-middle">Settings</span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <form action="{{ route('logout') }}" method="post">
                                @csrf
                                <a href="{{ route('logout') }}" class="sidebar-link"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                    <i class="align-middle" data-lucide="log-out"></i>
                                    <span class="align-middle">Log Out</span>
                                </a>
                            </form>
                        </li>
                    </ul>

                    <div class="sidebar-cta">
                        <div class="sidebar-cta-content">
                            <strong class="d-inline-block mb-2">Monthly Sales Report</strong>
                            <div class="mb-3 text-sm">
                                Your monthly sales report is ready for download!
                            </div>

                            <div class="d-grid">
                                <a href="https://themes.getbootstrap.com/product/appstack-responsive-admin-template/"
                                    class="btn btn-primary" target="_blank">Download</a>
                            </div>
                        </div>
                    </div>
                </div>
            </nav> --}}
        @endif

        <div class="main">
            <nav class="navbar navbar-expand-lg navbar-bg" style="padding: 0.5rem 1rem; height:4rem; position:fixed; top: 0; width: 100%; z-index: 1000;">
                @auth
                    <div class="container-fluid">
                        <a href="/" class="btn btn-lg me-2 rounded-circle">
                            <i class="fa-solid fa-heading icon-large"></i>
                        </a>

                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarNav">
                            <form method="GET" action="{{ route('profile.search') }}"
                                class="d-none d-sm-inline-block me-2">
                                <div class="input-group input-group-navbar">
                                    <input type="text" class="form-control rounded-left" name="query"
                                        placeholder="Search" aria-label="Search" required>
                                    <button class="btn rounded-right" type="submit">
                                        <i class="align-middle" data-lucide="search"></i>
                                    </button>
                                </div>
                            </form>

                            <div class="d-flex justify-content-center flex-grow-1 align-items-center gap-4 mx-3">
                                <a href="/"
                                    class="btn btn-lg position-relative nav-btn {{ request()->routeIs('home') ? 'active' : '' }}">
                                    <i
                                        class="fas fa-home fa-xl {{ request()->routeIs('home') ? 'text-primary' : 'text-dark' }}"></i>
                                    <span
                                        class="position-absolute bottom-0 start-50 translate-middle-x w-100 {{ request()->routeIs('home') ? '' : 'd-none' }}"
                                        style="border-bottom: 3px solid rgb(16,103,252);" aria-hidden="true"></span>
                                </a>

                                <a href="{{ route('watch.index') }}"
                                    class="btn btn-lg position-relative nav-btn">
                                    <i
                                        class="fas fa-tv fa-xl {{ request()->routeIs('watch.index') ? 'text-primary' : 'text-dark' }}"></i>
                                    <span
                                        class="position-absolute bottom-0 start-50 translate-middle-x w-100 {{ request()->routeIs('watch.show') ? '' : 'd-none' }}"
                                        style="border-bottom: 3px solid rgb(16,103,252);" aria-hidden="true"></span>
                                </a>

                                <a href="{{ route('profile.show', Auth::user()->username) }}"
                                    class="btn btn-lg position-relative nav-btn {{ request()->routeIs('profile.show', Auth::user()->username) ? 'active' : '' }}">
                                    <i
                                        class="fas fa-user fa-xl {{ request()->routeIs('profile.show', Auth::user()->username) ? 'text-primary' : 'text-dark' }}"></i>
                                    <span
                                        class="position-absolute bottom-0 start-50 translate-middle-x w-100 {{ request()->routeIs('profile.show', Auth::user()->username) ? '' : 'd-none' }}"
                                        style="border-bottom: 3px solid rgb(16,103,252);" aria-hidden="true"></span>
                                </a>
                            </div>

                            <ul class="navbar-nav d-flex justify-content-end align-items-center">
                                <li class="nav-item dropdown me-2">
                                    <div class="rounded-circle bg-light d-flex justify-content-center align-items-center"
                                        style="width:45px; height:45px">
                                        <a class="nav-icon dropdown-toggle" href="#" id="messagesDropdown"
                                            data-bs-toggle="dropdown">
                                            <div class="position-relative">
                                                <i class="fa-brands fa-facebook-messenger text-dark"></i>
                                                @if (Auth::user()->unreadMessagesCount() > 0)
                                                    <span
                                                        class="indicator">{{ Auth::user()->unreadMessagesCount() }}</span>
                                                @endif
                                            </div>
                                        </a>

                                        <div class="dropdown-menu dropdown-menu-end">
                                            <div class="row m-1">
                                                <div class="col col-md-12">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <h2 class="ms-3">Chats</h2>
                                                        <div class="d-flex gap-2">
                                                            <a href="#Options" class="btn rounded-cicrle iconBtn"><i
                                                                    class="fa-solid fa-ellipsis"></i></a>
                                                            <a href="#SeeAllMessages" class="btn rounded-cicrle iconBtn"><i
                                                                    class="fa-solid fa-maximize"></i></a>
                                                            <a href="#NewMessage" class="btn rounded-cicrle iconBtn"><i
                                                                    class="fa-solid fa-pen-to-square"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row m-2">
                                                <div class="col col-md-12">
                                                    <div class="input-group rounded">
                                                        <span class="input-group-text rounded-start">
                                                            <i class="fa-solid fa-magnifying-glass"></i>
                                                        </span>
                                                        <input type="text"
                                                            class="form-control form-control-lg rounded-end"
                                                            style="max-width: 100%;" placeholder="Search Messenger">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    @php
                                                        $currentUser = Auth::user();
                                                        $usersWithMessages = [];

                                                        // Collect users with their latest messages
                                                        foreach (\App\Models\User::all() as $user) {
                                                            if (
                                                                $currentUser
                                                                    ->sentMessages()
                                                                    ->where('receiver_id', $user->id)
                                                                    ->exists() ||
                                                                $currentUser
                                                                    ->receivedMessages()
                                                                    ->where('sender_id', $user->id)
                                                                    ->exists()
                                                            ) {
                                                                $latestMessage = $currentUser
                                                                    ->sentMessages()
                                                                    ->where('receiver_id', $user->id)
                                                                    ->orWhere(function ($query) use ($user) {
                                                                        $query
                                                                            ->where('sender_id', $user->id)
                                                                            ->where('receiver_id', Auth::id());
                                                                    })
                                                                    ->orderBy('created_at', 'desc')
                                                                    ->first();

                                                                $usersWithMessages[] = [
                                                                    'user' => $user,
                                                                    'latestMessage' => $latestMessage,
                                                                    'hasUnreadMessages' => $user
                                                                        ->unreadMessages()
                                                                        ->exists(),
                                                                ];
                                                            }
                                                        }

                                                        // Sort users by the latest message created_at timestamp
                                                        usort($usersWithMessages, function ($a, $b) {
                                                            return $b['latestMessage']->created_at <=>
                                                                $a['latestMessage']->created_at;
                                                        });
                                                    @endphp

                                                    @if ($usersWithMessages)
                                                        @foreach ($usersWithMessages as $item)
                                                            @php
                                                                $user = $item['user'];
                                                                $latestMessage = $item['latestMessage'];
                                                                $hasUnreadMessages = $item['hasUnreadMessages'];
                                                            @endphp

                                                            <a href="{{ route('messages.create', $user->id) }}"
                                                                class="list-group-item list-group-item-action border-0 m-3 w-auto">
                                                                {{-- onclick="event.preventDefault(); markAsRead({{ $user->id }})" --}}
                                                                <div class="d-flex justify-content-center align-items-center"
                                                                    style="height: 60px;"
                                                                    onmouseover="this.style.backgroundColor='#eeeeee';"
                                                                    onmouseout="this.style.backgroundColor='';">
                                                                    <img src="{{ $user->profile_picture ? asset('storage/' . $user->profile_picture) : asset('storage/profile_pictures/default-user.png') }}"
                                                                        class="rounded-circle shadow-sm border border-1"
                                                                        alt="{{ $user->username }}" width="50"
                                                                        height="50">
                                                                    <div class="flex-grow-1 ms-2">
                                                                        <strong>{{ $user->firstname }}
                                                                            {{ $user->lastname }}</strong>
                                                                        <p class="mb-0">
                                                                            @if ($latestMessage)
                                                                                {{ $latestMessage->sender_id === Auth::id() ? 'You: ' : '' }}{{ Str::limit($latestMessage->message, 35, '...') }}
                                                                                <span class="text-muted">
                                                                                    •
                                                                                    {{ customTimeDiff($latestMessage->created_at) }}
                                                                                </span>

                                                                                {{-- @if (!$message->is_read)
                                                                            <form
                                                                                action="{{ route('messages.markAsRead', $message->id) }}"
                                                                                method="POST">
                                                                                @csrf
                                                                                <button type="submit" class="btn btn-success d-none"></button>
                                                                            </form>
                                                                        @endif --}}
                                                                            @else
                                                                                No messages available
                                                                            @endif
                                                                        </p>
                                                                    </div>
                                                                    @if (!$hasUnreadMessages)
                                                                        <i
                                                                            class="fa-solid fa-circle text-primary icon-small float-end p-3"></i>
                                                                    @endif
                                                                </div>
                                                            </a>
                                                        @endforeach
                                                    @else
                                                        <div class="d-flex justify-content-center align-items-center"
                                                            style="height: 60px;">
                                                            <div class="flex-grow-1 ms-2 text-center">
                                                                <strong>{{ __('No conversations available') }}</strong>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>

                                <li class="nav-item dropdown">
                                    <div class="rounded-circle bg-light d-flex justify-content-center align-items-center"
                                        style="width:45px; height:45px">
                                        <a class="nav-icon dropdown-toggle" href="#" id="alertsDropdown"
                                            data-bs-toggle="dropdown">
                                            <div class="position-relative">
                                                {{-- <svg xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 448 512"><!-- SVG code --></svg> --}}
                                                <i class="fa-solid fa-bell text-dark"></i>
                                                @if (Auth::user()->unreadNotificationsCount())
                                                    <span
                                                        class="indicator">{{ Auth::user()->unreadNotificationsCount() }}</span>
                                                @endif
                                            </div>
                                        </a>
                                    </div>
                                </li>

                                <li class="nav-item dropdown">
                                    <a class="nav-link d-flex align-items-center" data-bs-toggle="dropdown">
                                        <img src="{{ Auth::user()->profile_picture ? asset('storage/' . Auth::user()->profile_picture) : asset('storage/profile_pictures/default-user.png') }}"
                                            class="rounded-circle me-2" alt="{{ Auth::user()->firstname }}"
                                            width="45" height="45" style="border: 1px solid #f0f0f0;" />
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a class='dropdown-item'
                                            href="{{ route('profile.show', Auth::user()->username) }}">
                                            <i class="align-middle me-1" data-lucide="user"></i> Profile
                                        </a>
                                        <a class="dropdown-item" href="{{ route('home') }}">
                                            <i class="align-middle me-1" data-lucide="pie-chart"></i> Analytics
                                        </a>
                                        <div class="dropdown-divider"></div>
                                        <a class='dropdown-item' href='/pages-settings'>Settings & Privacy</a>
                                        <a class="dropdown-item" href="#">Help</a>
                                        <form action="{{ route('logout') }}" method="post">
                                            @csrf
                                            <a class="dropdown-item" href="{{ route('logout') }}"
                                                onclick="event.preventDefault(); this.closest('form').submit();">Sign
                                                out</a>
                                        </form>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                @else
                    <div class="d-flex justify-content-end w-100">
                        <a href="{{ route('login') }}" class="btn btn-light btn-lg border-0 me-2">Log in</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn btn-primary btn-lg border-0">Register</a>
                        @endif
                    </div>
                @endauth
            </nav>

            <main class="content" style="margin-top:3rem;">
                {{ $slot }}
            </main>

            <footer class="footer">
                <div class="container-fluid">
                    <div class="row text-muted">
                        <div class="col-6 text-start">
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <a class="text-muted" href="#">Support</a>
                                </li>
                                <li class="list-inline-item">
                                    <a class="text-muted" href="#">Help Center</a>
                                </li>
                                <li class="list-inline-item">
                                    <a class="text-muted" href="#">Privacy</a>
                                </li>
                                <li class="list-inline-item">
                                    <a class="text-muted" href="#">Terms of Service</a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-6 text-end">
                            <p class="mb-0">
                                &copy; 2024 - <a class='text-muted' href='/'>Hunter</a>
                            </p>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

    @stack('scripts')

    <script>
        // document.addEventListener("DOMContentLoaded", function() {
        //     const loading = document.getElementById('loading');
        //     loading.style.display = 'flex';

        //     window.onload = function() {
        //         loading.style.display = 'none';
        //     };
        // });

        function markAsRead(userId) {
            fetch(`/messages/mark-read/${userId}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                },
            }).then(response => {
                if (!response.ok) {
                    console.error('Failed to mark messages as read.');
                }
            });
        }

        document.addEventListener('keydown', function(e) {
            if (e.key === 'F12' || (e.ctrlKey && e.shiftKey && e.key === 'I')) {
                e.preventDefault();
            }
        });

        document.addEventListener("DOMContentLoaded", function() {

            document.addEventListener('contextmenu', function(e) {
                e.preventDefault();
            });


            // Add event listener to the toggle button
            toggleButton.addEventListener('click', toggleSidebarBehavior);
            $("#datatables-products").DataTable({
                destroy: true,
                responsive: true,
                order: [
                    [1, "asc"]
                ],
                pageLength: 25,
                columnDefs: [{
                        targets: 0,
                        orderable: false,
                        width: "18px"
                    },
                    {
                        targets: 6,
                        orderable: false
                    }
                ],
                layout: {
                    topStart: null,
                    topEnd: null,
                    bottomStart: 'info',
                    bottomEnd: 'paging'
                }
            });
            $("#datatables-products-check-all").click(function() {
                if ($(this).prop("checked")) {
                    $("input[type='checkbox']").prop("checked", true);
                } else {
                    $("input[type='checkbox']").prop("checked", false);
                }
            });
            $("#datatables-products-search").keyup(function() {
                $("#datatables-products").DataTable().search($(this).val()).draw();
            });
        });
    </script>
</body>

</html>
