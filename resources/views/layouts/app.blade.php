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
</style>

<body>
    <div class="wrapper">
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
            <nav class="navbar navbar-expand-lg navbar-bg" style="padding: 0.5rem 1rem; height:4rem;">
                @auth
                    <div class="container-fluid">
                        <a href="/" class="btn btn-lg me-2 rounded-circle">
                            <h1>{{ __('H') }}</h1>
                        </a>
                        
                        {{-- <div class="d-flex justify-content-center flex-grow-1 align-items-center gap-4 mx-3">
                            <a href="{{ route('home') }}"
                                class="btn btn-transparent btn-lg position-relative nav-btn {{ request()->routeIs('home') ? 'active' : '' }}">
                                <i class="fas fa-home fa-xl"></i>
                                <span
                                    class="position-absolute bottom-0 start-50 translate-middle-x w-100 {{ request()->routeIs('home') ? '' : 'd-none' }}"
                                    style="border-bottom: 3px solid rgb(16,103,252);" aria-hidden="true"></span>
                            </a>

                            <a href="{{ route('watch.show', Auth::user()->id) }}"
                                class="btn btn-transparent btn-lg position-relative nav-btn">
                                <i class="fas fa-tv fa-xl"></i>
                                <span
                                    class="position-absolute bottom-0 start-50 translate-middle-x w-100 {{ request()->routeIs('watch.show') ? '' : 'd-none' }}"
                                    style="border-bottom: 3px solid rgb(16,103,252);" aria-hidden="true"></span>
                            </a>

                            <a href="{{ route('profile.show', Auth::user()->username) }}"
                                class="btn btn-transparent btn-lg position-relative nav-btn {{ request()->routeIs('profile.show', Auth::user()->username) ? 'active' : '' }}">
                                <i class="fas fa-user fa-xl"></i>
                                <span
                                    class="position-absolute bottom-0 start-50 translate-middle-x w-100 {{ request()->routeIs('profile.show', Auth::user()->username) ? '' : 'd-none' }}"
                                    style="border-bottom: 3px solid rgb(16,103,252);" aria-hidden="true"></span>
                            </a>
                        </div> --}}

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
                                    <i class="fas fa-home fa-xl"></i>
                                    <span
                                        class="position-absolute bottom-0 start-50 translate-middle-x w-100 {{ request()->routeIs('home') ? '' : 'd-none' }}"
                                        style="border-bottom: 3px solid rgb(16,103,252);" aria-hidden="true"></span>
                                </a>

                                <a href="{{ route('watch.show', Auth::user()->id) }}"
                                    class="btn btn-lg position-relative nav-btn">
                                    <i class="fas fa-tv fa-xl"></i>
                                    <span
                                        class="position-absolute bottom-0 start-50 translate-middle-x w-100 {{ request()->routeIs('watch.show') ? '' : 'd-none' }}"
                                        style="border-bottom: 3px solid rgb(16,103,252);" aria-hidden="true"></span>
                                </a>

                                <a href="{{ route('profile.show', Auth::user()->username) }}"
                                    class="btn btn-lg position-relative nav-btn {{ request()->routeIs('profile.show', Auth::user()->username) ? 'active' : '' }}">
                                    <i class="fas fa-user fa-xl"></i>
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
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 512 512"><!-- SVG code --></svg>
                                                @if (Auth::user()->unreadMessagesCount() > 0)
                                                    <span
                                                        class="indicator">{{ Auth::user()->unreadMessagesCount() }}</span>
                                                @endif
                                            </div>
                                        </a>
                                    </div>
                                </li>

                                <li class="nav-item dropdown">
                                    <div class="rounded-circle bg-light d-flex justify-content-center align-items-center"
                                        style="width:45px; height:45px">
                                        <a class="nav-icon dropdown-toggle" href="#" id="alertsDropdown"
                                            data-bs-toggle="dropdown">
                                            <div class="position-relative">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 448 512"><!-- SVG code --></svg>
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
                                        <img src="{{ Auth::user()->profile_pictures ? asset('storage/profile_pictures/' . Auth::user()->profile_pictures) : asset('storage/profile_pictures/default-user.png') }}"
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
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

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
