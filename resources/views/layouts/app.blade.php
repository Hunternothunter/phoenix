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

<body>
    <div class="wrapper">
        @if (Auth::user())
            <nav id="sidebar" class="sidebar">
                <div class="sidebar-content js-simplebar">
                    <a class='sidebar-brand' href='{{ route('dashboard') }}'>
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
                            <a href="{{ route('dashboard') }}" class="sidebar-link">
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
            </nav>
        @endif
        <div class="main">
            <nav class="navbar navbar-expand navbar-bg">
                @auth
                    <a class="sidebar-toggle">
                        <i class="hamburger align-self-center"></i>
                    </a>
                    <form method="GET" action="{{ route('profile.search') }}" class="d-none d-sm-inline-block">
                        <div class="input-group input-group-navbar">
                            <input type="text" class="form-control" name="query" placeholder="Search" aria-label="Search">
                            <button class="btn" type="submit">
                                <i class="align-middle" data-lucide="search"></i>
                            </button>
                        </div>
                    </form>

                    {{-- <form method="GET" action="{{ route('profile.search') }}" class="d-none d-sm-inline-block">
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">
                                <i class="bi bi-search" data-lucide="search"></i>
                            </span>
                            <input type="text" class="form-control" name="query" placeholder="Search"
                                aria-label="Search" aria-describedby="basic-addon1">
                        </div>
                    </form> --}}

                    <div class="navbar-collapse collapse">
                        <ul class="navbar-nav navbar-align">
                            <!-- Messages -->
                            <li class="nav-item dropdown">
                                <a class="nav-icon dropdown-toggle" href="#" id="messagesDropdown"
                                    data-bs-toggle="dropdown">
                                    <div class="position-relative">
                                        <i class="align-middle text-body" data-lucide="message-circle"></i>

                                        <span class="indicator">{{ Auth::user()->unreadMessagesCount() }}</span>
                                    </div>
                                </a>
                                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end py-0"
                                    aria-labelledby="messagesDropdown">
                                    <!-- Message content dynamically loaded -->
                                    <div class="dropdown-menu-header">
                                        <div class="position-relative">
                                            {{ Auth::user()->unreadMessagesCount() }} New Messages
                                        </div>
                                    </div>
                                    <!-- Loop through unread messages -->
                                    <div class="list-group">
                                        @foreach (Auth::user()->unreadMessages as $message)
                                            <a href="#" class="list-group-item">
                                                <div class="row g-0 align-items-center">
                                                    <div class="col-2">
                                                        <img src="{{ $message->sender->profilePictureUrl }}"
                                                            class="img-fluid rounded-circle"
                                                            alt="{{ $message->sender->name }}" width="40"
                                                            height="40">
                                                    </div>
                                                    <div class="col-10 ps-2">
                                                        <div>{{ $message->sender->name }}</div>
                                                        <div class="text-muted small mt-1">
                                                            {{ Str::limit($message->content, 50) }}</div>
                                                        <div class="text-muted small mt-1">
                                                            {{ $message->created_at->diffForHumans() }}</div>
                                                    </div>
                                                </div>
                                            </a>
                                        @endforeach
                                    </div>
                                    <div class="dropdown-menu-footer">
                                        <a href="{{ route('messages.index') }}" class="text-muted">Show all
                                            messages</a>
                                    </div>
                                </div>
                            </li>

                            <!-- Notifications -->
                            <li class="nav-item dropdown">
                                <a class="nav-icon dropdown-toggle" href="#" id="alertsDropdown"
                                    data-bs-toggle="dropdown">
                                    <div class="position-relative">
                                        <i class="align-middle text-body" data-lucide="bell"></i>
                                        <span class="indicator">{{ Auth::user()->unreadNotificationsCount() }}</span>
                                    </div>
                                </a>
                                <!-- Notification dropdown similar to messages -->
                            </li>

                            <!-- Profile -->
                            <li class="nav-item dropdown">
                                <a class="nav-link d-none d-sm-inline-block" data-bs-toggle="dropdown">
                                    <img src="{{ Auth::user()->profile_picture ? asset('storage/' . Auth::user()->profile_picture) : asset('storage/profile-pictures/default-user.png') }}"
                                        class="rounded-circle me-1 mt-n2 mb-n2" alt="{{ Auth::user()->firstname }}"
                                        width="40" height="40" style="border: 2px solid #f0f0f0;" />
                                    <span>{{ Auth::user()->firstname }}</span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a class='dropdown-item'
                                        href="{{ route('profile.show', Auth::user()->username) }}"><i
                                            class="align-middle me-1" data-lucide="user"></i> Profile</a>
                                    <a class="dropdown-item" href="{{ route('dashboard') }}"><i
                                            class="align-middle me-1" data-lucide="pie-chart"></i> Analytics</a>
                                    <div class="dropdown-divider"></div>
                                    <a class='dropdown-item' href='/pages-settings'>Settings & Privacy</a>
                                    <a class="dropdown-item" href="#">Help</a>
                                    <form action="{{ route('logout') }}" method="post">
                                        @csrf
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault(); this.closest('form').submit();">
                                            Sign out
                                        </a>
                                    </form>
                                </div>
                            </li>
                        </ul>
                    </div>
                @else
                    <div class="d-flex justify-content-end w-100">
                        <a href="{{ route('login') }}" class="btn btn-transparent border-0 me-2"
                            style="background-color: transparent; transition: background-color 0.3s; border-radius: 5px; font-size:16px;"
                            onmouseover="this.style.backgroundColor='#f8f9fa';"
                            onmouseout="this.style.backgroundColor='transparent';">
                            Log in
                        </a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn btn-transparent border-0"
                                style="background-color: transparent; transition: background-color 0.3s; border-radius: 5px; font-size:16px;"
                                onmouseover="this.style.backgroundColor='#f8f9fa';"
                                onmouseout="this.style.backgroundColor='transparent';">
                                Register
                            </a>
                        @endif
                    </div>
                @endauth
            </nav>

            <main class="content">
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

    @stack('scripts')

    <script>
        document.addEventListener("DOMContentLoaded", function() {

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
