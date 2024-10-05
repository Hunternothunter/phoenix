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
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <link href="css/app.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
    @vite(['resources/css/theme.min.css', 'resources/js/phoenix.js'])

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
        padding: 0.75rem;
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
        width: 3rem;
        height: 50px;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 2rem;
    }

    .iconBtn:hover {
        background-color: #eeeeee;
    }

    #searchResults {
        display: block !important;
        z-index: 1050;
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
    /*

    .messenger-icon {
        position: fixed;
        bottom: 20px;
        right: 20px;
        background-color: #0078FF;
        color: white;
        border-radius: 50%;
        width: 50px;
        height: 50px;
        display: flex;
        justify-content: center;
        align-items: center;
        cursor: pointer;
        z-index: 1000;
    }

    .iconProfile {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 50%;
    }

    .chat-box {
        display: none;
        position: fixed;
        bottom: 0;
        right: 5rem;
        width: 325px;
        height: 450px;
        background-color: white;
        border: 1px solid #ddd;
        border-radius: 10px 10px 0 0;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        z-index: 1000;
    }

    .chat-header {
        background-color: #ffffff;
        color: rgb(255, 255, 255);
        padding: 10px;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
        border-bottom: 1px solid;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .chat-body {
        padding: 10px;
        overflow-y: auto;
        height: 280px;
        background-color: #f0f0f0;
    }

    .message {
        padding: 8px;
        margin-bottom: 5px;
        background-color: #ffffff;
        border-radius: 10px;
        width: fit-content;
    }

    .sender {
        background-color: #0078FF;
        color: white;
        margin-left: auto;
    }

    .chat-footer {
        padding: 10px;
        display: flex;
        align-items: center;
    }

    .chat-footer input {
        flex: 1;
        margin-right: 10px;
    } */
</style>

<body>

    <nav class="navbar navbar-top fixed-top navbar-expand-lg" id="navbarCombo" data-navbar-top="combo"
        data-move-target="#navbarVerticalNav">
        <div class="navbar-logo">
            <button class="btn navbar-toggler navbar-toggler-humburger-icon hover-bg-transparent" type="button"
                data-bs-toggle="collapse" data-bs-target="#navbarVerticalCollapse"
                aria-controls="navbarVerticalCollapse" aria-expanded="false" aria-label="Toggle Navigation"><span
                    class="navbar-toggle-icon"><span class="toggle-line"></span></span></button>
            <a class="navbar-brand me-1 me-sm-3" href="{{ route('home') }}">
                <div class="d-flex align-items-center">
                    <div class="d-flex align-items-center">
                        <img src="{{ asset('storage/app_logo/app-logo.png') }}" alt="" width="100" />
                        {{-- <i class="fa-solid fa-h text-primary"></i> --}}
                    </div>
                </div>
            </a>
        </div>

        <div class="collapse navbar-collapse navbar-top-collapse order-1 order-lg-0 justify-content-center"
            id="navbarTopCollapse">
            <ul class="navbar-nav navbar-nav-top" data-dropdown-on-hover="data-dropdown-on-hover">
                <li class="nav-item dropdown nav-btn">
                    <a class="nav-link " href="{{ route('home') }}" role="button">
                        <i class="fa-solid fa-house fa-2x d-flex align-items-center justify-content-center"></i>
                    </a>
                </li>
                <li class="nav-item dropdown nav-btn">
                    <a class="nav-link " href="{{ route('watch.index') }}" role="button">
                        <i class="fa-solid fa-tv fa-2x d-flex align-items-center justify-content-center"></i>
                    </a>
                </li>
                <li class="nav-item dropdown nav-btn">
                    <a class="nav-link " href="{{ route('home') }}" role="button">
                        <i class="fa-solid fa-users fa-2x d-flex align-items-center justify-content-center"></i>
                    </a>
                </li>
            </ul>
        </div>

        <ul class="navbar-nav navbar-nav-icons flex-row d-none d-md-flex">
            <li class="nav-item">
                <div class="theme-control-toggle fa-icon-wait px-2">
                    <i class="fa-solid fa-moon icon"></i>
                    <input class="form-check-input ms-0 theme-control-toggle-input" type="checkbox"
                        data-theme-control="phoenixTheme" value="dark" id="themeControlToggle" />
                    <label class="mb-0 theme-control-toggle-label theme-control-toggle-light" for="themeControlToggle"
                        data-bs-toggle="tooltip" data-bs-placement="left" data-bs-title="Switch theme"
                        style="height:32px;width:32px;">
                        {{-- <span class="icon" data-feather="moon"></span> --}}
                    </label>
                    <label class="mb-0 theme-control-toggle-label theme-control-toggle-dark" for="themeControlToggle"
                        data-bs-toggle="tooltip" data-bs-placement="left" data-bs-title="Switch theme"
                        style="height:32px;width:32px;">
                        {{-- <span class="icon" data-feather="sun"></span> --}}
                        <i class="fa-solid fa-sun icon"></i>
                    </label>
                </div>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link" id="navbarDropdownNindeDots" href="#" role="button" data-bs-toggle="dropdown"
                    aria-haspopup="true" data-bs-auto-close="outside" aria-expanded="false">
                    <svg width="22" height="22" viewbox="0 0 16 16" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <circle cx="2" cy="2" r="2" fill="currentColor"></circle>
                        <circle cx="2" cy="8" r="2" fill="currentColor"></circle>
                        <circle cx="2" cy="14" r="2" fill="currentColor"></circle>
                        <circle cx="8" cy="8" r="2" fill="currentColor"></circle>
                        <circle cx="8" cy="14" r="2" fill="currentColor"></circle>
                        <circle cx="14" cy="8" r="2" fill="currentColor"></circle>
                        <circle cx="14" cy="14" r="2" fill="currentColor"></circle>
                        <circle cx="8" cy="2" r="2" fill="currentColor"></circle>
                        <circle cx="14" cy="2" r="2" fill="currentColor"></circle>
                    </svg>
                </a>
                <div class="dropdown-menu dropdown-menu-end navbar-dropdown-caret py-0 dropdown-nine-dots shadow border"
                    aria-labelledby="navbarDropdownNindeDots">
                    <div class="card bg-body-emphasis position-relative border-0">
                        <div class="card-body pt-3 px-3 pb-0 overflow-auto scrollbar" style="height: 20rem;">
                            <div class="row text-center align-items-center gx-0 gy-0">
                                <div class="col-4"><a
                                        class="d-block bg-body-secondary-hover p-2 rounded-3 text-center text-decoration-none mb-3"
                                        href="#!"><img src="../../assets/img/nav-icons/behance.webp"
                                            alt="" width="30" />
                                        <p class="mb-0 text-body-emphasis text-truncate fs-10 mt-1 pt-1">Behance</p>
                                    </a></div>
                                <div class="col-4"><a
                                        class="d-block bg-body-secondary-hover p-2 rounded-3 text-center text-decoration-none mb-3"
                                        href="#!"><img src="../../assets/img/nav-icons/google-cloud.webp"
                                            alt="" width="30" />
                                        <p class="mb-0 text-body-emphasis text-truncate fs-10 mt-1 pt-1">Cloud</p>
                                    </a></div>
                                <div class="col-4"><a
                                        class="d-block bg-body-secondary-hover p-2 rounded-3 text-center text-decoration-none mb-3"
                                        href="#!"><img src="../../assets/img/nav-icons/slack.webp"
                                            alt="" width="30" />
                                        <p class="mb-0 text-body-emphasis text-truncate fs-10 mt-1 pt-1">Slack</p>
                                    </a></div>
                                <div class="col-4"><a
                                        class="d-block bg-body-secondary-hover p-2 rounded-3 text-center text-decoration-none mb-3"
                                        href="#!"><img src="../../assets/img/nav-icons/gitlab.webp"
                                            alt="" width="30" />
                                        <p class="mb-0 text-body-emphasis text-truncate fs-10 mt-1 pt-1">Gitlab</p>
                                    </a></div>
                                <div class="col-4"><a
                                        class="d-block bg-body-secondary-hover p-2 rounded-3 text-center text-decoration-none mb-3"
                                        href="#!"><img src="../../assets/img/nav-icons/bitbucket.webp"
                                            alt="" width="30" />
                                        <p class="mb-0 text-body-emphasis text-truncate fs-10 mt-1 pt-1">BitBucket</p>
                                    </a></div>
                                <div class="col-4"><a
                                        class="d-block bg-body-secondary-hover p-2 rounded-3 text-center text-decoration-none mb-3"
                                        href="#!"><img src="../../assets/img/nav-icons/google-drive.webp"
                                            alt="" width="30" />
                                        <p class="mb-0 text-body-emphasis text-truncate fs-10 mt-1 pt-1">Drive</p>
                                    </a></div>
                                <div class="col-4"><a
                                        class="d-block bg-body-secondary-hover p-2 rounded-3 text-center text-decoration-none mb-3"
                                        href="#!"><img src="../../assets/img/nav-icons/trello.webp"
                                            alt="" width="30" />
                                        <p class="mb-0 text-body-emphasis text-truncate fs-10 mt-1 pt-1">Trello</p>
                                    </a></div>
                                <div class="col-4"><a
                                        class="d-block bg-body-secondary-hover p-2 rounded-3 text-center text-decoration-none mb-3"
                                        href="#!"><img src="../../assets/img/nav-icons/figma.webp"
                                            alt="" width="20" />
                                        <p class="mb-0 text-body-emphasis text-truncate fs-10 mt-1 pt-1">Figma</p>
                                    </a></div>
                                <div class="col-4"><a
                                        class="d-block bg-body-secondary-hover p-2 rounded-3 text-center text-decoration-none mb-3"
                                        href="#!"><img src="../../assets/img/nav-icons/twitter.webp"
                                            alt="" width="30" />
                                        <p class="mb-0 text-body-emphasis text-truncate fs-10 mt-1 pt-1">Twitter</p>
                                    </a></div>
                                <div class="col-4"><a
                                        class="d-block bg-body-secondary-hover p-2 rounded-3 text-center text-decoration-none mb-3"
                                        href="#!"><img src="../../assets/img/nav-icons/pinterest.webp"
                                            alt="" width="30" />
                                        <p class="mb-0 text-body-emphasis text-truncate fs-10 mt-1 pt-1">Pinterest</p>
                                    </a></div>
                                <div class="col-4"><a
                                        class="d-block bg-body-secondary-hover p-2 rounded-3 text-center text-decoration-none mb-3"
                                        href="#!"><img src="../../assets/img/nav-icons/ln.webp" alt=""
                                            width="30" />
                                        <p class="mb-0 text-body-emphasis text-truncate fs-10 mt-1 pt-1">Linkedin</p>
                                    </a></div>
                                <div class="col-4"><a
                                        class="d-block bg-body-secondary-hover p-2 rounded-3 text-center text-decoration-none mb-3"
                                        href="#!"><img src="../../assets/img/nav-icons/google-maps.webp"
                                            alt="" width="30" />
                                        <p class="mb-0 text-body-emphasis text-truncate fs-10 mt-1 pt-1">Maps</p>
                                    </a></div>
                                <div class="col-4"><a
                                        class="d-block bg-body-secondary-hover p-2 rounded-3 text-center text-decoration-none mb-3"
                                        href="#!"><img src="../../assets/img/nav-icons/google-photos.webp"
                                            alt="" width="30" />
                                        <p class="mb-0 text-body-emphasis text-truncate fs-10 mt-1 pt-1">Photos</p>
                                    </a></div>
                                <div class="col-4"><a
                                        class="d-block bg-body-secondary-hover p-2 rounded-3 text-center text-decoration-none mb-3"
                                        href="#!"><img src="../../assets/img/nav-icons/spotify.webp"
                                            alt="" width="30" />
                                        <p class="mb-0 text-body-emphasis text-truncate fs-10 mt-1 pt-1">Spotify</p>
                                    </a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#searchBoxModal">
                    <i class="fa-solid fa-magnifying-glass fa-2x d-flex align-items-center justify-content-center"></i>
                </a>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link" href="#" style="min-width: 2.25rem" role="button"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                    data-bs-auto-close="outside">
                    <i class="fa-brands fa-facebook-messenger fa-2x"></i>
                </a>

                @php
                    $currentUser = Auth::user();
                    $usersWithLatestMessages = [];

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
                                    $query->where('sender_id', $user->id)->where('receiver_id', Auth::id());
                                })
                                ->orderBy('created_at', 'desc')
                                ->first();

                            $hasUnreadMessages = $user->unreadMessages()->exists();

                            $usersWithLatestMessages[] = [
                                'user' => $user,
                                'latestMessage' => $latestMessage,
                                'hasUnreadMessages' => $hasUnreadMessages,
                            ];
                        }
                    }

                    usort($usersWithLatestMessages, function ($a, $b) {
                        return $b['latestMessage']->created_at <=> $a['latestMessage']->created_at;
                    });

                    $selectedUserId = last(request()->segments());
                @endphp

                <div class="dropdown-menu dropdown-menu-end notification-dropdown-menu py-0 shadow border navbar-dropdown-caret"
                    id="navbarDropdownNotfication" aria-labelledby="navbarDropdownNotfication">
                    <div class="card position-relative border-0">
                        <div class="card-header p-2">
                            <div class="d-flex justify-content-between">
                                <h5 class="text-body-emphasis mb-0">Chats</h5>
                                <button class="btn btn-link p-0 fs-9 fw-normal" type="button">Mark all as
                                    read</button>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="scrollbar-overlay" style="height: 27rem;">
                                <div data-chat-thread-tab-content="data-chat-thread-tab-content">
                                    <ul class="nav chat-thread-tab flex-column list">
                                        @foreach ($usersWithLatestMessages as $item)
                                            @php
                                                $user = $item['user'];
                                                $latestMessage = $item['latestMessage'];
                                                $hasUnreadMessages = $item['hasUnreadMessages'];
                                            @endphp

                                            <li class="nav-item mb-1 cursor-pointer"
                                                id="messengerIcon_{{ $user->id }}" role="presentation">
                                                {{-- add active class at the end of the p-2 --}}
                                                {{-- data-bs-toggle="tab" data-chat-thread="data-chat-thread" --}}

                                                <a class="nav-link d-flex align-items-center justify-content-center p-2 "
                                                    data-chat-thread="data-chat-thread">
                                                    {{-- href="{{ route('messages.create', $user->id) }}"> --}}
                                                    <div
                                                        class="avatar avatar-xl status-online position-relative me-2 me-sm-0 me-xl-2">
                                                        <img class="rounded-circle border-light-subtle"
                                                            src="{{ $user->profile_picture ? asset('storage/' . $user->profile_picture) : asset('storage/profile_pictures/default-user.png') }}"
                                                            alt="" />
                                                    </div>
                                                    <div class="flex-1 d-sm-none d-xl-block">
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <h5 class="text-body fw-normal name text-nowrap">
                                                                {{ $user->firstname }} {{ $user->lastname }}
                                                                @if ($user->is_verified)
                                                                    <span
                                                                        class="fa-solid fa-check-circle text-primary ms-1 fa-xs"
                                                                        title="Verified"></span>
                                                                @endif
                                                            </h5>
                                                            <p
                                                                class="fs-10 text-body-tertiary text-opacity-85 mb-0 text-nowrap">
                                                                {{ customTimeDiff($latestMessage->created_at) }}
                                                            </p>
                                                        </div>
                                                        <div class="d-flex justify-content-between">
                                                            <p
                                                                class="fs-9 mb-0 line-clamp-1 text-body-tertiary text-opacity-85 message">
                                                                @if ($latestMessage)
                                                                    {{ $latestMessage->sender_id === Auth::id() ? 'You: ' : '' }}{{ Str::limit($latestMessage->message, 35, '...') }}
                                                                @else
                                                                    No messages available
                                                                @endif
                                                            </p>
                                                        </div>
                                                    </div>
                                                    {{-- @if (!$hasUnreadMessages)
                                                    <i class="fa-solid fa-circle text-primary icon-small float-end"></i>
                                                @endif --}}
                                                </a>
                                            </li>
                                            {{-- <!-- Chat Box for each user -->
                                            <div class="chat-box" id="chatBox_{{ $user->id }}"
                                                style="display: none;">
                                                <div class="chat-header">
                                                    <span class="text-white">{{ $user->firstname }}
                                                        {{ $user->lastname }}</span>
                                                    <button id="closeChat_{{ $user->id }}">Close</button>
                                                </div>
                                                <div class="chat-content">
                                                    <!-- Chat messages go here -->
                                                    @foreach ($messages as $message)
                                                        @if ($message->sender_id == $user->id || $message->receiver_id == $user->id)
                                                            <p>{{ $message->message }}</p>
                                                        @endif
                                                    @endforeach
                                                    <p>{{ $latestMessage->message }}</p>
                                                </div>
                                            </div> --}}

                                            {{-- @foreach ($users as $user) --}}
                                            {{-- <div class="chat-box d-none position-fixed bottom-0 end-2 w-25 w-md-325px h-60 bg-white border border-light rounded-top shadow-lg z-index-1000"
                                                id="chatBox_{{ $user->id }}">
                                                <div
                                                    class="chat-header d-flex justify-content-between align-items-center bg-white p-3 rounded-top border-bottom">
                                                    <span class="text-dark">{{ $user->firstname }}
                                                        {{ $user->lastname }}</span>
                                                    <button class="btn btn-sm btn-link"
                                                        id="closeChat_{{ $user->id }}">Close</button>
                                                </div>
                                                <div class="chat-content p-3 overflow-auto h-100">
                                                    @foreach ($messages[$user->id] ?? [] as $message)
                                                        <p class="mb-2 bg-light rounded p-2">{{ $message->message }}
                                                        </p>
                                                    @endforeach
                                                </div>
                                            </div> --}}
                                            {{-- @endforeach --}}
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link" href="#" style="min-width: 2.25rem" role="button"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                    data-bs-auto-close="outside">
                    <i class="fa-solid fa-bell fa-2x"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-end notification-dropdown-menu py-0 shadow border navbar-dropdown-caret"
                    id="navbarDropdownNotfication" aria-labelledby="navbarDropdownNotfication">
                    <div class="card position-relative border-0">
                        <div class="card-header p-2">
                            <div class="d-flex justify-content-between">
                                <h5 class="text-body-emphasis mb-0">Notifications</h5>
                                <button class="btn btn-link p-0 fs-9 fw-normal" type="button">Mark all as
                                    read</button>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="scrollbar-overlay" style="height: 27rem;">
                                <div class="px-2 px-sm-3 py-3 notification-card position-relative read border-bottom">
                                    <div class="d-flex align-items-center justify-content-between position-relative">
                                        <div class="d-flex">
                                            <div class="avatar avatar-m status-online me-3"><img
                                                    class="rounded-circle" src="../../assets/img/team/40x40/30.webp"
                                                    alt="" /></div>
                                            <div class="flex-1 me-sm-3">
                                                <h4 class="fs-9 text-body-emphasis">Jessie Samson</h4>
                                                <p class="fs-9 text-body-highlight mb-2 mb-sm-3 fw-normal"><span
                                                        class='me-1 fs-10'>💬</span>Mentioned you in a comment.<span
                                                        class="ms-2 text-body-quaternary text-opacity-75 fw-bold fs-10">10m</span>
                                                </p>
                                                <p class="text-body-secondary fs-9 mb-0"><span
                                                        class="me-1 fas fa-clock"></span><span class="fw-bold">10:41
                                                        AM </span>August 7,2021</p>
                                            </div>
                                        </div>
                                        <div class="dropdown notification-dropdown"><button
                                                class="btn fs-10 btn-sm dropdown-toggle dropdown-caret-none transition-none"
                                                type="button" data-bs-toggle="dropdown" data-boundary="window"
                                                aria-haspopup="true" aria-expanded="false"
                                                data-bs-reference="parent"><span
                                                    class="fas fa-ellipsis-h fs-10 text-body"></span></button>
                                            <div class="dropdown-menu py-2"><a class="dropdown-item"
                                                    href="#!">Mark as unread</a></div>
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="px-2 px-sm-3 py-3 notification-card position-relative unread border-bottom">
                                    <div class="d-flex align-items-center justify-content-between position-relative">
                                        <div class="d-flex">
                                            <div class="avatar avatar-m status-online me-3">
                                                <div class="avatar-name rounded-circle"><span>J</span></div>
                                            </div>
                                            <div class="flex-1 me-sm-3">
                                                <h4 class="fs-9 text-body-emphasis">Jane Foster</h4>
                                                <p class="fs-9 text-body-highlight mb-2 mb-sm-3 fw-normal"><span
                                                        class='me-1 fs-10'>📅</span>Created an event.<span
                                                        class="ms-2 text-body-quaternary text-opacity-75 fw-bold fs-10">20m</span>
                                                </p>
                                                <p class="text-body-secondary fs-9 mb-0"><span
                                                        class="me-1 fas fa-clock"></span><span class="fw-bold">10:20
                                                        AM </span>August 7,2021</p>
                                            </div>
                                        </div>
                                        <div class="dropdown notification-dropdown"><button
                                                class="btn fs-10 btn-sm dropdown-toggle dropdown-caret-none transition-none"
                                                type="button" data-bs-toggle="dropdown" data-boundary="window"
                                                aria-haspopup="true" aria-expanded="false"
                                                data-bs-reference="parent"><span
                                                    class="fas fa-ellipsis-h fs-10 text-body"></span></button>
                                            <div class="dropdown-menu py-2"><a class="dropdown-item"
                                                    href="#!">Mark as unread</a></div>
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="px-2 px-sm-3 py-3 notification-card position-relative unread border-bottom">
                                    <div class="d-flex align-items-center justify-content-between position-relative">
                                        <div class="d-flex">
                                            <div class="avatar avatar-m status-online me-3"><img
                                                    class="rounded-circle avatar-placeholder"
                                                    src="../../assets/img/team/40x40/avatar.webp" alt="" />
                                            </div>
                                            <div class="flex-1 me-sm-3">
                                                <h4 class="fs-9 text-body-emphasis">Jessie Samson</h4>
                                                <p class="fs-9 text-body-highlight mb-2 mb-sm-3 fw-normal"><span
                                                        class='me-1 fs-10'>👍</span>Liked your comment.<span
                                                        class="ms-2 text-body-quaternary text-opacity-75 fw-bold fs-10">1h</span>
                                                </p>
                                                <p class="text-body-secondary fs-9 mb-0"><span
                                                        class="me-1 fas fa-clock"></span><span class="fw-bold">9:30
                                                        AM </span>August 7,2021</p>
                                            </div>
                                        </div>
                                        <div class="dropdown notification-dropdown"><button
                                                class="btn fs-10 btn-sm dropdown-toggle dropdown-caret-none transition-none"
                                                type="button" data-bs-toggle="dropdown" data-boundary="window"
                                                aria-haspopup="true" aria-expanded="false"
                                                data-bs-reference="parent"><span
                                                    class="fas fa-ellipsis-h fs-10 text-body"></span></button>
                                            <div class="dropdown-menu py-2"><a class="dropdown-item"
                                                    href="#!">Mark as unread</a></div>
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="px-2 px-sm-3 py-3 notification-card position-relative unread border-bottom">
                                    <div class="d-flex align-items-center justify-content-between position-relative">
                                        <div class="d-flex">
                                            <div class="avatar avatar-m status-online me-3"><img
                                                    class="rounded-circle" src="../../assets/img/team/40x40/57.webp"
                                                    alt="" /></div>
                                            <div class="flex-1 me-sm-3">
                                                <h4 class="fs-9 text-body-emphasis">Kiera Anderson</h4>
                                                <p class="fs-9 text-body-highlight mb-2 mb-sm-3 fw-normal"><span
                                                        class='me-1 fs-10'>💬</span>Mentioned you in a comment.<span
                                                        class="ms-2 text-body-quaternary text-opacity-75 fw-bold fs-10"></span>
                                                </p>
                                                <p class="text-body-secondary fs-9 mb-0"><span
                                                        class="me-1 fas fa-clock"></span><span class="fw-bold">9:11
                                                        AM </span>August 7,2021</p>
                                            </div>
                                        </div>
                                        <div class="dropdown notification-dropdown"><button
                                                class="btn fs-10 btn-sm dropdown-toggle dropdown-caret-none transition-none"
                                                type="button" data-bs-toggle="dropdown" data-boundary="window"
                                                aria-haspopup="true" aria-expanded="false"
                                                data-bs-reference="parent"><span
                                                    class="fas fa-ellipsis-h fs-10 text-body"></span></button>
                                            <div class="dropdown-menu py-2"><a class="dropdown-item"
                                                    href="#!">Mark as unread</a></div>
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="px-2 px-sm-3 py-3 notification-card position-relative unread border-bottom">
                                    <div class="d-flex align-items-center justify-content-between position-relative">
                                        <div class="d-flex">
                                            <div class="avatar avatar-m status-online me-3"><img
                                                    class="rounded-circle" src="../../assets/img/team/40x40/59.webp"
                                                    alt="" /></div>
                                            <div class="flex-1 me-sm-3">
                                                <h4 class="fs-9 text-body-emphasis">Herman Carter</h4>
                                                <p class="fs-9 text-body-highlight mb-2 mb-sm-3 fw-normal"><span
                                                        class='me-1 fs-10'>👤</span>Tagged you in a comment.<span
                                                        class="ms-2 text-body-quaternary text-opacity-75 fw-bold fs-10"></span>
                                                </p>
                                                <p class="text-body-secondary fs-9 mb-0"><span
                                                        class="me-1 fas fa-clock"></span><span class="fw-bold">10:58
                                                        PM </span>August 7,2021</p>
                                            </div>
                                        </div>
                                        <div class="dropdown notification-dropdown"><button
                                                class="btn fs-10 btn-sm dropdown-toggle dropdown-caret-none transition-none"
                                                type="button" data-bs-toggle="dropdown" data-boundary="window"
                                                aria-haspopup="true" aria-expanded="false"
                                                data-bs-reference="parent"><span
                                                    class="fas fa-ellipsis-h fs-10 text-body"></span></button>
                                            <div class="dropdown-menu py-2"><a class="dropdown-item"
                                                    href="#!">Mark as unread</a></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="px-2 px-sm-3 py-3 notification-card position-relative read ">
                                    <div class="d-flex align-items-center justify-content-between position-relative">
                                        <div class="d-flex">
                                            <div class="avatar avatar-m status-online me-3"><img
                                                    class="rounded-circle" src="../../assets/img/team/40x40/58.webp"
                                                    alt="" /></div>
                                            <div class="flex-1 me-sm-3">
                                                <h4 class="fs-9 text-body-emphasis">Benjamin Button</h4>
                                                <p class="fs-9 text-body-highlight mb-2 mb-sm-3 fw-normal"><span
                                                        class='me-1 fs-10'>👍</span>Liked your comment.<span
                                                        class="ms-2 text-body-quaternary text-opacity-75 fw-bold fs-10"></span>
                                                </p>
                                                <p class="text-body-secondary fs-9 mb-0"><span
                                                        class="me-1 fas fa-clock"></span><span class="fw-bold">10:18
                                                        AM </span>August 7,2021</p>
                                            </div>
                                        </div>
                                        <div class="dropdown notification-dropdown"><button
                                                class="btn fs-10 btn-sm dropdown-toggle dropdown-caret-none transition-none"
                                                type="button" data-bs-toggle="dropdown" data-boundary="window"
                                                aria-haspopup="true" aria-expanded="false"
                                                data-bs-reference="parent"><span
                                                    class="fas fa-ellipsis-h fs-10 text-body"></span></button>
                                            <div class="dropdown-menu py-2"><a class="dropdown-item"
                                                    href="#!">Mark as unread</a></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer p-0 border-top border-translucent border-0">
                            <div class="my-2 text-center fw-bold fs-10 text-body-tertiary text-opactity-85"><a
                                    class="fw-bolder" href="../../pages/notifications.html">Notification history</a>
                            </div>
                        </div>
                    </div>
                </div>
            </li>

            <li class="nav-item dropdown"><a class="nav-link lh-1 pe-0" id="navbarDropdownUser" role="button"
                    data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-haspopup="true"
                    aria-expanded="false">
                    <div class="avatar avatar-l ">
                        <img class="rounded-circle "
                            src="{{ asset('storage/' . Auth::user()->profile_picture) ?? asset('storage/profile_pictures/default-user.png') }}" />
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-end navbar-dropdown-caret py-0 dropdown-profile shadow border"
                    aria-labelledby="navbarDropdownUser">
                    <div class="card position-relative border-0">
                        <div class="card-body p-0">
                            <div class="text-center pt-4 pb-3">
                                <div class="avatar avatar-xl ">
                                    <img class="rounded-circle "
                                        src="{{ asset('storage/' . Auth::user()->profile_picture) ?? asset('storage/profile_pictures/default-user.png') }}" />
                                </div>
                                <h6 class="mt-2 text-body-emphasis">{{ Auth::user()->firstname }}
                                    {{ Auth::user()->lastname }}</h6>
                            </div>
                            <div class="mb-3 mx-3"><input class="form-control form-control-sm" id="statusUpdateInput"
                                    type="text" placeholder="Update your status" />
                            </div>
                        </div>
                        <div class="overflow-auto scrollbar" style="height: 10rem;">
                            <ul class="nav d-flex flex-column mb-2 pb-1">
                                <li class="nav-item">
                                    <a class="nav-link px-3 d-block"
                                        href="{{ route('profile.show', Auth::user()->username) }}">
                                        <span class="me-2 text-body align-bottom" data-feather="user"></span>
                                        <span>Profile</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link px-3 d-block" href="{{ route('home') }}">
                                        <span class="me-2 text-body align-bottom" data-feather="pie-chart"></span>
                                        Dashboard
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link px-3 d-block" href="#!">
                                        <span class="me-2 text-body align-bottom" data-feather="lock"></span>
                                        Posts &amp; Activity
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link px-3 d-block" href="#!">
                                        <span class="me-2 text-body align-bottom" data-feather="settings"></span>
                                        Settings &amp; Privacy
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link px-3 d-block" href="#!">
                                        <span class="me-2 text-body align-bottom" data-feather="help-circle"></span>
                                        Help Center
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link px-3 d-block" href="#!">
                                        <span class="me-2 text-body align-bottom" data-feather="globe"></span>
                                        Language
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-footer p-0 border-top border-translucent">
                            <ul class="nav d-flex flex-column my-3">
                                <li class="nav-item"><a class="nav-link px-3 d-block" href="#!"> <span
                                            class="me-2 text-body align-bottom" data-feather="user-plus"></span>Add
                                        another account</a></li>
                            </ul>
                            <hr />
                            <div class="px-3">
                                <form action="{{ route('logout') }}" method="post">
                                    @csrf
                                    @method('POST')

                                    <button type="submit" class="btn btn-phoenix-secondary d-flex flex-center w-100">
                                        <span class="me-2" data-feather="log-out"></span>
                                        Sign Out
                                    </button>
                                </form>
                            </div>
                            <div class="my-2 text-center fw-bold fs-10 text-body-quaternary"><a
                                    class="text-body-quaternary me-1" href="#!">Privacy policy</a>&bull;<a
                                    class="text-body-quaternary mx-1" href="#!">Terms</a>&bull;<a
                                    class="text-body-quaternary ms-1" href="#!">Cookies</a></div>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
    </nav>

    {{ $slot }}


    <div class="chat-box d-none position-fixed bottom-0 end-2 w-25 w-md-325px h-60 bg-white border border-light rounded-top shadow-lg z-index-1000"
        {{-- id="chatBox_{{ $user->id }}"> --}} id="chatBox">
        <div class="chat-header d-flex justify-content-between align-items-center bg-white p-3 rounded-top border-bottom">
            <div class="nav-item dropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-bs-auto-close="outside">
                <span class="text-dark">{{ $user->firstname }}
                    {{ $user->lastname }}</span>
            </div>

            <div class="dropdown-menu dropdown-menu-end notification-dropdown-menu py-0 shadow border navbar-dropdown-caret">
                <div class="bg-white">
                    <ul class="nav chat-thread-tab flex-column list">
                        <li class="nav-item mb-1 cursor-pointer">
                            <a href="{{ route('messages.create', $user->id) }}" class="text-decoration-none text-dark">
                                <i class="fa-brands fa-facebook-messenger"></i>
                                Open in Messenger
                            </a>
                        </li>
                        <li class="nav-item mb-1 cursor-pointer">
                            <a href="{{ route('profile.show', $user->username) }}" class="text-decoration-none text-dark">
                                <i class="fa-solid fa-user"></i>
                                View Profile
                            </a>
                        </li>
                        <li class="nav-item mb-1 cursor-pointer">Archive Chat</li>
                        <li class="nav-item mb-1 cursor-pointer">Delete Chat</li>
                    </ul>
                </div>
            </div>
            <button class="btn btn-sm btn-link" id="closeChat">Close</button>
        </div>
        <div class="chat-content p-3 overflow-auto h-100">
            @foreach ($messages[$user->id] ?? [] as $message)
                <p class="mb-2 bg-light rounded p-2">{{ $message->message }}
                </p>
            @endforeach
        </div>
    </div>

    <div class="messenger-icon position-fixed bottom-3 end-3 bg-primary text-white rounded-circle d-flex justify-content-center align-items-center cursor-pointer z-index-1000"
        style="width: 50px; height: 50px;">
        <img class="rounded-circle border-2 border-light" style="width: 100%; height: 100%; object-fit: cover;"
            src="{{ $user->profile_picture ? asset('storage/' . $user->profile_picture) : asset('storage/profile_pictures/default-user.png') }}"
            alt="" />
    </div>

    {{-- @include('profile.search_results', [
        'recentSearches' => session()->get('recent_searches', []),
        'users' => $users ?? collect(),
        'query' => $query ?? '',
    ]) --}}

    {{-- <div class="modal fade" id="searchBoxModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="true"
        data-phoenix-modal="data-phoenix-modal" style="--phoenix-backdrop-opacity: 1;">
        <div class="modal-dialog">
            <div class="modal-content mt-15 rounded-pill">
                <div class="modal-body p-0">
                    <div class="search-box navbar-top-search-box" data-list='{"valueNames":["title"]}'
                        style="width: auto;">
                        <form action="{{ route('profile.search') }}" method="GET" class="position-relative"
                            data-bs-toggle="search" data-bs-display="static">
                            <input class="form-control search-input fuzzy-search rounded-pill form-control-lg"
                                type="search" name="query" placeholder="Search Space" aria-label="Search"
                                required />
                            <span class="fas fa-search search-box-icon"></span>
                        </form>
                        <div class="btn-close position-absolute end-0 top-50 translate-middle cursor-pointer shadow-none"
                            data-bs-dismiss="search">
                            <button class="btn btn-link p-0" aria-label="Close"></button>
                        </div>
                        <div class="dropdown-menu border start-0 py-0 overflow-hidden w-100">
                        <div class="scrollbar-overlay" style="max-height: 30rem;">
                            <div class="list pb-3">
                                <h6 class="dropdown-header text-body-highlight fs-10 py-2">
                                    {{ count($users) }} 
                                    <span class="text-body-quaternary">results</span>
                                </h6>
                                <hr class="my-0" />
                                <h6 class="dropdown-header text-body-highlight fs-9 border-translucent py-2 lh-sm">
                                    Recently Searched
                                </h6>
                                <div class="py-2">
                                    @foreach ($recentSearches as $search)
                                        <a class="dropdown-item"
                                            href="{{ route('profile.search', ['query' => $search]) }}">
                                            <div class="d-flex align-items-center">
                                                <div class="fw-normal text-body-highlight title">
                                                    <span class="fa-solid fa-clock-rotate-left"
                                                        data-fa-transform="shrink-2"></span>
                                                    {{ $search }}
                                                </div>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                                <hr class="my-0" />
                                <h6 class="dropdown-header text-body-highlight fs-9 border-translucent py-2 lh-sm">
                                    Search Results
                                </h6>
                                <div class="py-2">
                                    @if ($users->isEmpty())
                                        <p class="dropdown-item text-body-tertiary">No results found.</p>
                                    @else
                                        @foreach ($users as $user)
                                            <a class="dropdown-item"
                                                href="{{ route('profile.show', $user->username) }}">
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar avatar-l me-2">
                                                        <img class="rounded-circle"
                                                            src="{{ asset('storage/' . $user->profile_picture) }}"
                                                            alt="{{ $user->firstname }}" />
                                                    </div>
                                                    <div class="fw-normal text-body-highlight title">
                                                        {{ $user->firstname }} {{ $user->lastname }}
                                                    </div>
                                                </div>
                                            </a>
                                        @endforeach
                                    @endif
                                </div>
                                <hr class="my-0" />
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
    </div> --}}

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

    <div class="modal fade" id="searchBoxModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="true"
        style="--phoenix-backdrop-opacity: 1;">
        <div class="modal-dialog">
            <div class="modal-content mt-15 rounded-pill">
                <div class="modal-body p-0">
                    <div class="search-box navbar-top-search-box" style="width: auto;">
                        <form id="searchForm" class="position-relative" onsubmit="return false;">
                            <input class="form-control search-input fuzzy-search rounded-pill form-control-lg"
                                type="search" name="query" placeholder="Search Space" aria-label="Search" />
                            <span class="fas fa-search search-box-icon"></span>
                        </form>
                        <div class="btn-close position-absolute end-0 top-50 translate-middle cursor-pointer shadow-none"
                            data-bs-dismiss="search">
                            <button class="btn btn-link p-0" aria-label="Close"></button>
                        </div>
                        <div id="searchResults" class="dropdown-menu border start-0 py-0 overflow-hidden w-100"
                            style="display:none;">
                            <div class="scrollbar-overlay" style="max-height: 30rem;">
                                <div class="list pb-3">
                                    <h6 class="dropdown-header text-body-highlight fs-10 py-2">
                                        <span id="resultsCount">0</span>
                                        <span class="text-body-quaternary">results</span>
                                    </h6>
                                    <hr class="my-0" />
                                    <h6 class="dropdown-header text-body-highlight fs-9 border-translucent py-2 lh-sm">
                                        Recently Searched</h6>
                                    <div id="recentSearches" class="py-2">
                                        <p class="dropdown-item text-body-tertiary">No recent searches.</p>
                                    </div>
                                    <hr class="my-0" />
                                    <h6 class="dropdown-header text-body-highlight fs-9 border-translucent py-2 lh-sm">
                                        Search Results</h6>
                                    <div id="dynamicResults" class="py-2">
                                        <p class="dropdown-item text-body-tertiary">No results found.</p>
                                    </div>
                                    <hr class="my-0" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <script>
                        $(document).ready(function() {
                            // Display recent searches on load
                            displayRecentSearches();

                            // Search on input
                            $('input[name="query"]').on('input', function() {
                                let query = $(this).val().trim();
                                if (query.length >= 3) {
                                    performSearch(query);
                                } else {
                                    $('#searchResults').hide(); // Hide results if query is too short
                                    displayRecentSearches(); // Display recent searches
                                }
                            });

                            // Function to perform the AJAX search
                            function performSearch(query) {
                                $.ajax({
                                    url: "{{ route('profile.search') }}",
                                    method: "GET",
                                    data: {
                                        query: query
                                    },
                                    success: function(data) {
                                        updateSearchResults(data);
                                    },
                                    error: function(xhr) {
                                        console.log(xhr.responseText);
                                    }
                                });
                            }

                            // Function to update search results
                            function updateSearchResults(data) {
                                let resultsHtml = '';
                                if (data.users.length > 0) {
                                    data.users.forEach(user => {
                                        resultsHtml += `
                                            <a class="dropdown-item" href="{{ url('profile') }}/${user.username}">
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar avatar-l me-2">
                                                        <img class="rounded-circle" src="${user.profile_picture}" alt="${user.firstname}" />
                                                    </div>
                                                    <div class="fw-normal text-body-highlight title">
                                                        ${user.firstname} ${user.lastname}
                                                    </div>
                                                </div>
                                            </a>`;
                                    });
                                    $('#resultsCount').text(data.users.length);
                                } else {
                                    resultsHtml = '<p class="dropdown-item text-body-tertiary">No results found.</p>';
                                    $('#resultsCount').text(0);
                                }
                                $('#dynamicResults').html(resultsHtml);
                                displayRecentSearches(data.recentSearches); // Update recent searches
                                $('#searchResults').show(); // Show results
                            }

                            // Function to display recent searches
                            function displayRecentSearches(recentSearches = []) {
                                let recentSearchesHtml = '';
                                if (recentSearches.length > 0) {
                                    recentSearches.forEach(search => {
                                        recentSearchesHtml += `
                                            <a class="dropdown-item" href="{{ route('profile.search', ['query' => '${search}']) }}">
                                                <div class="d-flex align-items-center">
                                                    <div class="fw-normal text-body-highlight title">
                                                        <span class="fa-solid fa-clock-rotate-left" data-fa-transform="shrink-2"></span>
                                                        ${search}
                                                    </div>
                                                </div>
                                            </a>`;
                                    });
                                } else {
                                    recentSearchesHtml = '<p class="dropdown-item text-body-tertiary">No recent searches.</p>';
                                }
                                $('#recentSearches').html(recentSearchesHtml);
                            }
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    {{-- 
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script> --}}

    @stack('scripts')

    <script>
        // $(document).ready(function() {
        //     $('#searchForm').on('submit', function(e) {
        //         e.preventDefault();
        //         let query = $('input[name="query"]').val();

        //         $.ajax({
        //             url: "{{ route('profile.search') }}",
        //             method: "GET",
        //             data: {
        //                 query: query
        //             },
        //             success: function(data) {
        //                 $('#searchResults').html(data);
        //             },
        //             error: function(xhr) {
        //                 console.log(xhr.responseText);
        //             }
        //         });
        //     });
        // });

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

        document.querySelectorAll('[id^="messengerIcon_"]').forEach(icon => {
            const userId = icon.id.split('_')[1]; // Extract user ID from the icon's ID
            const chatBox = document.getElementById(`chatBox`);
            const closeChat = document.getElementById(`closeChat`);

            // Open chat box when messenger icon is clicked
            icon.addEventListener('click', () => {
                chatBox.classList.remove('d-none'); // Remove 'd-none' class to show the chat box
            });

            // Close chat box when the close button is clicked
            closeChat.addEventListener('click', () => {
                chatBox.classList.add('d-none'); // Add 'd-none' class to hide the chat box
            });
        });
    </script>
</body>

</html>
