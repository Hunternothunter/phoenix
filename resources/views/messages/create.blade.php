<x-app-layout>
    <div class="content">
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

        <div class="chat d-flex phoenix-offcanvas-container pt-1 mt-n1 mb-9">
            <div class="card p-3 p-xl-1 mt-xl-n1 chat-sidebar me-3 phoenix-offcanvas phoenix-offcanvas-start"
                id="chat-sidebar">
                <button class="btn d-none d-sm-block d-xl-none mb-2" data-bs-toggle="modal"
                    data-bs-target="#chatSearchBoxModal">
                    <span class="fa-solid fa-magnifying-glass text-body-tertiary text-opacity-85 fs-7"></span>
                </button>
                <div class="d-none d-sm-block d-xl-none mb-5">
                    <button class="btn w-100 mx-auto" type="button" data-bs-toggle="dropdown" data-boundary="window"
                        aria-haspopup="true" aria-expanded="false" data-bs-reference="parent">
                        <span class="fa-solid fa-bars text-body-tertiary text-opacity-85 fs-7"></span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end p-0">
                        <li><a class="dropdown-item" href="#!">All</a></li>
                        <li><a class="dropdown-item" href="#!">Read</a></li>
                        <li><a class="dropdown-item" href="#!">Unread</a></li>
                    </ul>
                </div>
                <div class="form-icon-container mb-4 d-sm-none d-xl-block">
                    <input class="form-control form-icon-input" type="text"
                        placeholder="People, Groups and Messages" />
                    <span class="fas fa-user text-body fs-9 form-icon"></span>
                </div>
                <ul class="nav nav-phoenix-pills mb-5 d-sm-none d-xl-flex" id="contactListTab"
                    data-chat-thread-tab="data-chat-thread-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link cursor-pointer active" data-bs-toggle="tab" data-chat-thread-list="all"
                            role="tab" aria-selected="true">
                            All
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link cursor-pointer" data-bs-toggle="tab" role="tab"
                            data-chat-thread-list="read" aria-selected="false">
                            Read
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link cursor-pointer" data-bs-toggle="tab" role="tab"
                            data-chat-thread-list="unread" aria-selected="false">
                            Unread
                        </a>
                    </li>
                </ul>
                <div class="scrollbar">
                    <div class="tab-content" id="contactListTabContent">
                        <div data-chat-thread-tab-content="data-chat-thread-tab-content">
                            <ul class="nav chat-thread-tab flex-column list">
                                @foreach ($usersWithLatestMessages as $item)
                                    @php
                                        $user = $item['user'];
                                        $latestMessage = $item['latestMessage'];
                                        $hasUnreadMessages = $item['hasUnreadMessages'];
                                    @endphp

                                    <li class="nav-item mb-1" role="presentation">
                                        {{-- add active class at the end of the p-2 --}}
                                        {{-- data-bs-toggle="tab" data-chat-thread="data-chat-thread" --}}

                                        <a class="nav-link d-flex align-items-center justify-content-center p-2 " data-chat-thread="data-chat-thread" href="{{ route('messages.create', $user->id) }}">
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
                                                            <span class="fa-solid fa-check-circle text-primary ms-1 fa-xs" 
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
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card tab-content flex-1 phoenix-offcanvas-container">
                <div class="tab-pane h-100 fade active show" id="tab-thread-1" role="tabpanel"
                    aria-labelledby="tab-thread-1">
                    <div class="d-flex flex-column h-100">
                        @if (isset($receiver))
                            <div class="card-header p-3 p-md-4 d-flex flex-between-center">
                                <div class="d-flex align-items-center">
                                    <button class="btn ps-0 pe-2 text-body-tertiary d-sm-none"
                                        data-phoenix-toggle="offcanvas" data-phoenix-target="#chat-sidebar">
                                        <span class="fa-solid fa-chevron-left"></span>
                                    </button>
                                    <div class="d-flex flex-column flex-md-row align-items-md-center">
                                        <button
                                            class="btn fs-7 fw-semibold text-body-emphasis d-flex align-items-center p-0 me-3 text-start"
                                            data-phoenix-toggle="offcanvas" data-phoenix-target="#thread-details-0">
                                            <img src="{{ $receiver->profile_picture ? asset('storage/' . $receiver->profile_picture) : asset('storage/profile_pictures/default-user.png') }}"
                                                class="rounded-circle me-2" alt="{{ $receiver->username }}"
                                                width="40" height="40">
                                            <span class="line-clamp-1">{{ $receiver->firstname }}
                                                {{ $receiver->lastname }}</span>
                                            <span class="fa-solid fa-chevron-down ms-2 fs-10"></span>
                                        </button>
                                        <p class="fs-9 mb-0 me-2">
                                            <span class="fa-solid fa-circle text-success fs-11 me-2"></span>
                                            Active now
                                        </p>
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <button class="btn btn-icon btn-primary me-1">
                                        <span class="fa-solid fa-phone"></span>
                                    </button>
                                    <button class="btn btn-icon btn-primary me-1">
                                        <span class="fa-solid fa-video"></span>
                                    </button>
                                    <button class="btn btn-icon btn-phoenix-primary" type="button"
                                        data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true"
                                        aria-expanded="false" data-bs-reference="parent">
                                        <span class="fa-solid fa-ellipsis-vertical"></span>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end p-0">
                                        <li><a class="dropdown-item" href="#!">Add to favourites</a></li>
                                        <li><a class="dropdown-item" href="#!">View profile</a></li>
                                        <li><a class="dropdown-item" href="#!">Report</a></li>
                                        <li><a class="dropdown-item" href="#!">Manage notifications</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-body p-3 p-sm-4 scrollbar chat-content-body-0">
                                @foreach ($messages as $message)
                                    <div class="d-flex chat-message">
                                        @if ($message->sender_id === $currentUser->id)
                                            <div class="d-flex mb-2 justify-content-end flex-1">
                                                <div class="w-100 w-xxl-75">
                                                    <div class="d-flex flex-end-center hover-actions-trigger">
                                                        <div
                                                            class="d-sm-none hover-actions align-self-center me-2 start-0">
                                                            <div
                                                                class="bg-body-emphasis rounded-pill d-flex align-items-center border px-2 actions">
                                                                <button class="btn p-2" type="button">
                                                                    <span
                                                                        class="fa-solid fa-reply text-primary"></span>
                                                                </button>
                                                                <button class="btn p-2" type="button">
                                                                    <span
                                                                        class="fa-solid fa-pen-to-square text-primary"></span>
                                                                </button>
                                                                <button class="btn p-2" type="button">
                                                                    <span
                                                                        class="fa-solid fa-trash text-primary"></span>
                                                                </button>
                                                                <button class="btn p-2" type="button">
                                                                    <span
                                                                        class="fa-solid fa-share text-primary"></span>
                                                                </button>
                                                                <button class="btn p-2" type="button">
                                                                    <span
                                                                        class="fa-solid fa-face-smile text-primary"></span>
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <div class="d-none d-sm-flex">
                                                            <div
                                                                class="hover-actions position-relative align-self-center">
                                                                <button class="btn p-2 fs-10"><span
                                                                        class="fa-solid fa-reply text-primary"></span></button><button
                                                                    class="btn p-2 fs-10"><span
                                                                        class="fa-solid fa-pen-to-square text-primary"></span></button><button
                                                                    class="btn p-2 fs-10"><span
                                                                        class="fa-solid fa-share text-primary"></span></button><button
                                                                    class="btn p-2 fs-10"><span
                                                                        class="fa-solid fa-trash text-primary"></span></button><button
                                                                    class="btn p-2 fs-10"><span
                                                                        class="fa-solid fa-face-smile text-primary"></span></button>
                                                            </div>
                                                        </div>
                                                        <div class="chat-message-content me-2">
                                                            <div class="mb-1 sent-message-content bg-primary rounded-2 p-3 text-white"
                                                                data-bs-theme="light">
                                                                <p class="mb-0">{{ $message->message }}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="text-end">
                                                        <p
                                                            class="mb-0 fs-10 text-body-tertiary text-opacity-85 fw-semibold">
                                                            {{ customTimeDiff($message->created_at) }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            <div class="d-flex mb-2 flex-1">
                                                <div class="w-100 w-xxl-75">
                                                    <div class="d-flex hover-actions-trigger">
                                                        <div class="avatar avatar-m me-3 flex-shrink-0">
                                                            <img class="rounded-circle"
                                                                src="{{ $message->sender->profile_picture ? asset('storage/' . $message->sender->profile_picture) : asset('storage/profile_pictures/default-user.png') }}"
                                                                alt="" />
                                                        </div>
                                                        <div class="chat-message-content received me-2">
                                                            <div
                                                                class="mb-2 received-message-content border rounded-2 p-3">
                                                                <p class="mb-0">{{ $message->message }}</p>
                                                            </div>
                                                        </div>
                                                        <div class="d-none d-sm-flex">
                                                            <div
                                                                class="hover-actions position-relative align-self-center me-2">
                                                                <button class="btn p-2 fs-10">
                                                                    <span class="fa-solid fa-reply"></span>
                                                                </button>
                                                                <button class="btn p-2 fs-10">
                                                                    <span class="fa-solid fa-trash"></span>
                                                                </button>
                                                                <button class="btn p-2 fs-10">
                                                                    <span class="fa-solid fa-share"></span>
                                                                </button>
                                                                <button class="btn p-2 fs-10">
                                                                    <span class="fa-solid fa-face-smile"></span>
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <div
                                                            class="d-sm-none hover-actions align-self-center me-2 end-0">
                                                            <div
                                                                class="bg-body-emphasis rounded-pill d-flex align-items-center border px-2 actions">
                                                                <button class="btn p-2" type="button">
                                                                    <span
                                                                        class="fa-solid fa-reply text-primary"></span>
                                                                </button>
                                                                <button class="btn p-2" type="button">
                                                                    <span
                                                                        class="fa-solid fa-trash text-primary"></span>
                                                                </button>
                                                                <button class="btn p-2" type="button">
                                                                    <span
                                                                        class="fa-solid fa-share text-primary"></span>
                                                                </button>
                                                                <button class="btn p-2" type="button">
                                                                    <span
                                                                        class="fa-solid fa-face-smile text-primary"></span>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <p
                                                        class="mb-0 fs-10 text-body-tertiary text-opacity-85 fw-semibold ms-7">
                                                        {{ customTimeDiff($message->created_at) }}
                                                    </p>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="card-header p-3 p-md-4 d-flex flex-between-center">
                                <div class="d-flex align-items-center">
                                    <p class="fs-9 mb-0 me-2">
                                        <span class="fa-solid fa-circle text-success fs-11 me-2"></span>
                                        Start a conversation.
                                    </p>
                                </div>
                            </div>
                        @endif
                        <div class="card-footer">
                            <form action="{{ route('messages.store') }}" method="POST">
                                @csrf

                                <input type="hidden" name="receiver_id" value="{{ $receiver->id }}">

                                {{-- <div class="chat-textarea outline-none scrollbar mb-1" name="message" contenteditable="true"></div> --}}

                                {{-- <textarea class="chat-textarea outline-none scrollbar w-100 mb-1 resize-none border-0" 
                                placeholder="Write a message" name="message" id="message">
                                </textarea> --}}
                                
                                <input type="text" class="chat-textarea outline-none scrollbar w-100 mb-1 resize-none border-0" 
                                placeholder="Write a message" name="message" id="message">
                                </input>
                                
                                <div class="d-flex justify-content-between align-items-end">
                                    <div>
                                        <button class="btn btn-link py-0 ps-0 pe-2 text-body fs-9 btn-emoji"
                                            data-picmo="data-picmo">
                                            <span class="fa-regular fa-face-smile"></span>
                                        </button>
                                        <label class="btn btn-link py-0 px-2 text-body fs-9" for="chatPhotos-0">
                                            <span class="fa-solid fa-image"></span>
                                        </label>
                                        <input class="d-none" type="file" accept="image/*" id="chatPhotos-0" />
                                        <label class="btn btn-link py-0 px-2 text-body fs-9" for="chatAttachment-0">
                                            <span class="fa-solid fa-paperclip"></span>
                                        </label>
                                        <input class="d-none" type="file" id="chatAttachment-0" />
                                        <button class="btn btn-link py-0 px-2 text-body fs-9">
                                            <span class="fa-solid fa-microphone"></span>
                                        </button>
                                        <button class="btn btn-link py-0 px-2 text-body fs-9">
                                            <span class="fa-solid fa-ellipsis"></span>
                                        </button>
                                    </div>
                                    <div>
                                        <button class="btn btn-primary fs-10" type="submit">
                                            Send
                                            <span class="fa-solid fa-paper-plane ms-1"></span>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="phoenix-offcanvas phoenix-offcanvas-top h-100 w-100 bg-body-emphasis scrollbar z-index-0 rounded"
                            id="thread-details-0">
                            <div class="border-bottom border-translucent p-4">
                                <div class="d-flex flex-between-center"><button class="btn p-0"
                                        data-phoenix-dismiss="offcanvas"><span
                                            class="fa-solid fa-chevron-left text-body-tertiary"></span></button><button
                                        class="btn p-0 btn-reveal dropdown-toggle dropdown-caret-none transition-none"
                                        type="button" data-bs-toggle="dropdown" data-boundary="window"
                                        aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><span
                                            class="fas fa-ellipsis-v text-body-tertiary"></span></button>
                                    <div class="dropdown-menu dropdown-menu-end py-2"><a class="dropdown-item"
                                            href="#!">View</a><a class="dropdown-item" href="#!">Export</a>
                                        <div class="dropdown-divider"></div><a class="dropdown-item text-danger"
                                            href="#!">Remove</a>
                                    </div>
                                </div>
                                <div class="d-flex flex-column align-items-center text-center">
                                    <div class="avatar avatar-4xl mb-2"><img
                                            class="rounded-circle border border-2 border-light-subtle"
                                            src="../assets/img/team/20.webp" alt="" /></div>
                                    <h4 class="fw-semibold mb-3">Sharuka Nijibum</h4>
                                    <div class="d-flex"><button class="btn btn-primary btn-icon fs-10 me-1"><span
                                                class="fas fa-phone"></span></button><button
                                            class="btn btn-primary btn-icon fs-10 me-1"><span
                                                class="fas fa-video"></span></button><button
                                            class="btn btn-phoenix-secondary btn-icon fs-10"><span
                                                class="fas fa-search"></span></button></div>
                                </div>
                            </div>
                            <div class="p-4 px-sm-5 scrollbar"><button class="btn d-block p-0 fw-semibold mb-3"><span
                                        class="fa-solid fa-user-pen me-3"></span>Nickname</button><button
                                    class="btn d-block p-0 fw-semibold mb-3"><span
                                        class="fa-solid fa-palette me-3"></span>Change Color</button><button
                                    class="btn d-block p-0 fw-semibold mb-5"><span
                                        class="fa-solid fa-user-plus me-3"></span>Create Group Chat</button>
                                <div class="d-flex mb-5"><span class="fa-solid fa-photo-film me-3 fs-9"></span>
                                    <div>
                                        <h6 class="fw-semibold mb-2">Shared Media</h6>
                                        <div class="row g-2">
                                            <div class="col-auto"><a href="../assets/img/chat/2.png"
                                                    data-gallery="gallery"> <img
                                                        class="object-fit-cover rounded-2 bg-body-secondary-hover"
                                                        src="../assets/img/chat/2.png" alt="" height="100"
                                                        width="100" /></a></div>
                                            <div class="col-auto"><a href="../assets/img/chat/3.png"
                                                    data-gallery="gallery"> <img
                                                        class="object-fit-cover rounded-2 bg-body-secondary-hover"
                                                        src="../assets/img/chat/3.png" alt="" height="100"
                                                        width="100" /></a></div>
                                            <div class="col-auto"><a href="../assets/img/chat/4.png"
                                                    data-gallery="gallery"> <img
                                                        class="object-fit-cover rounded-2 bg-body-secondary-hover"
                                                        src="../assets/img/chat/4.png" alt="" height="100"
                                                        width="100" /></a></div>
                                            <div class="col-auto"><a href="../assets/img/chat/5.png"
                                                    data-gallery="gallery"> <img
                                                        class="object-fit-cover rounded-2 bg-body-secondary-hover"
                                                        src="../assets/img/chat/5.png" alt="" height="100"
                                                        width="100" /></a></div>
                                            <div class="col-auto"><a href="../assets/img/chat/6.png"
                                                    data-gallery="gallery"> <img
                                                        class="object-fit-cover rounded-2 bg-body-secondary-hover"
                                                        src="../assets/img/chat/6.png" alt="" height="100"
                                                        width="100" /></a></div>
                                            <div class="col-auto"><a href="../assets/img/chat/7.png"
                                                    data-gallery="gallery"> <img
                                                        class="object-fit-cover rounded-2 bg-body-secondary-hover"
                                                        src="../assets/img/chat/7.png" alt="" height="100"
                                                        width="100" /></a></div>
                                            <div class="col-auto"><a href="../assets/img/chat/8.png"
                                                    data-gallery="gallery"> <img
                                                        class="object-fit-cover rounded-2 bg-body-secondary-hover"
                                                        src="../assets/img/chat/8.png" alt="" height="100"
                                                        width="100" /></a></div>
                                            <div class="col-auto"><a href="../assets/img/chat/9.png"
                                                    data-gallery="gallery"> <img
                                                        class="object-fit-cover rounded-2 bg-body-secondary-hover"
                                                        src="../assets/img/chat/9.png" alt="" height="100"
                                                        width="100" /></a></div>
                                            <div class="col-auto"><a href="../assets/img/chat/10.png"
                                                    data-gallery="gallery"> <img
                                                        class="object-fit-cover rounded-2 bg-body-secondary-hover"
                                                        src="../assets/img/chat/10.png" alt="" height="100"
                                                        width="100" /></a></div>
                                            <div class="col-auto"><a href="../assets/img/chat/11.png"
                                                    data-gallery="gallery"> <img
                                                        class="object-fit-cover rounded-2 bg-body-secondary-hover"
                                                        src="../assets/img/chat/11.png" alt="" height="100"
                                                        width="100" /></a></div>
                                            <div class="col-auto"><a href="../assets/img/chat/12.png"
                                                    data-gallery="gallery"> <img
                                                        class="object-fit-cover rounded-2 bg-body-secondary-hover"
                                                        src="../assets/img/chat/12.png" alt="" height="100"
                                                        width="100" /></a></div>
                                            <div class="col-auto"><a href="../assets/img/chat/13.png"
                                                    data-gallery="gallery"> <img
                                                        class="object-fit-cover rounded-2 bg-body-secondary-hover"
                                                        src="../assets/img/chat/13.png" alt="" height="100"
                                                        width="100" /></a></div>
                                            <div class="col-auto"><a href="../assets/img/chat/14.png"
                                                    data-gallery="gallery"> <img
                                                        class="object-fit-cover rounded-2 bg-body-secondary-hover"
                                                        src="../assets/img/chat/14.png" alt="" height="100"
                                                        width="100" /></a></div>
                                            <div class="col-auto"><a href="../assets/img/chat/2.png"
                                                    data-gallery="gallery"> <img
                                                        class="object-fit-cover rounded-2 bg-body-secondary-hover"
                                                        src="../assets/img/chat/2.png" alt="" height="100"
                                                        width="100" /></a></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-5">
                                    <div class="d-flex"><span class="fa-solid fa-folder me-3 fs-9"></span>
                                        <div class="flex-1">
                                            <h6 class="fw-semibold border-bottom border-translucent pb-2 mb-0">Shared
                                                Files</h6>
                                            <div class="mb-2">
                                                <div
                                                    class="border-bottom border-translucent d-flex align-items-center justify-content-between">
                                                    <a class="text-decoration-none d-flex align-items-center py-3"
                                                        href="#!">
                                                        <div
                                                            class="btn-icon btn-icon-lg border rounded-3 text-body-quaternary flex-column me-2">
                                                            <span class="fs-8 mb-1 fa-solid fa-file-zipper"></span>
                                                            <p class="mb-0 fs-10 fw-bold lh-1">zip</p>
                                                        </div>
                                                        <div class="flex-1">
                                                            <h6 class="text-body line-clamp-1">
                                                                Federico_godarf_design.zip</h6>
                                                            <div class="d-flex align-items-center lh-1">
                                                                <p class="fs-10 mb-0 text-body-tertiary fw-semibold">
                                                                    53.34 MB</p><span
                                                                    class="fa-solid fa-circle text-body-quaternary fs-10"
                                                                    data-fa-transform="shrink-12"></span>
                                                                <p class="fs-10 mb-0 text-body-tertiary fw-semibold">
                                                                    Dec 8, 2011</p>
                                                            </div>
                                                        </div>
                                                    </a><button class="btn p-0"><span
                                                            class="fa-regular fa-arrow-alt-circle-down fs-8 text-body-tertiary"></span></button>
                                                </div>
                                                <div
                                                    class="border-bottom border-translucent d-flex align-items-center justify-content-between">
                                                    <a class="text-decoration-none d-flex align-items-center py-3"
                                                        href="#!">
                                                        <div
                                                            class="btn-icon btn-icon-lg border rounded-3 text-body-quaternary flex-column me-2">
                                                            <span class="fs-8 mb-1 fa-solid fa-file-code"></span>
                                                            <p class="mb-0 fs-10 fw-bold lh-1">bat</p>
                                                        </div>
                                                        <div class="flex-1">
                                                            <h6 class="text-body line-clamp-1">Restart_lyf.bat</h6>
                                                            <div class="d-flex align-items-center lh-1">
                                                                <p class="fs-10 mb-0 text-body-tertiary fw-semibold">
                                                                    11.13 KB</p><span
                                                                    class="fa-solid fa-circle text-body-quaternary fs-10"
                                                                    data-fa-transform="shrink-12"></span>
                                                                <p class="fs-10 mb-0 text-body-tertiary fw-semibold">
                                                                    Dec 2, 2011</p>
                                                            </div>
                                                        </div>
                                                    </a><button class="btn p-0"><span
                                                            class="fa-regular fa-arrow-alt-circle-down fs-8 text-body-tertiary"></span></button>
                                                </div>
                                                <div
                                                    class="border-bottom border-translucent d-flex align-items-center justify-content-between">
                                                    <a class="text-decoration-none d-flex align-items-center py-3"
                                                        href="#!">
                                                        <div
                                                            class="btn-icon btn-icon-lg border rounded-3 text-body-quaternary flex-column me-2">
                                                            <span class="fs-8 mb-1 fa-solid fa-file-lines"></span>
                                                            <p class="mb-0 fs-10 fw-bold lh-1">txt</p>
                                                        </div>
                                                        <div class="flex-1">
                                                            <h6 class="text-body line-clamp-1">Fake lorem ipsum fr
                                                                fr.txt</h6>
                                                            <div class="d-flex align-items-center lh-1">
                                                                <p class="fs-10 mb-0 text-body-tertiary fw-semibold">
                                                                    11.13 KB</p><span
                                                                    class="fa-solid fa-circle text-body-quaternary fs-10"
                                                                    data-fa-transform="shrink-12"></span>
                                                                <p class="fs-10 mb-0 text-body-tertiary fw-semibold">
                                                                    Dec 2, 2011</p>
                                                            </div>
                                                        </div>
                                                    </a><button class="btn p-0"><span
                                                            class="fa-regular fa-arrow-alt-circle-down fs-8 text-body-tertiary"></span></button>
                                                </div>
                                                <div
                                                    class="border-bottom border-translucent d-flex align-items-center justify-content-between">
                                                    <a class="text-decoration-none d-flex align-items-center py-3"
                                                        href="#!">
                                                        <div
                                                            class="btn-icon btn-icon-lg border rounded-3 text-body-quaternary flex-column me-2">
                                                            <span
                                                                class="fs-8 mb-1 fa-solid fa-file-circle-exclamation"></span>
                                                            <p class="mb-0 fs-10 fw-bold lh-1">mad</p>
                                                        </div>
                                                        <div class="flex-1">
                                                            <h6 class="text-body line-clamp-1">Unsupported file
                                                                format.mad</h6>
                                                            <div class="d-flex align-items-center lh-1">
                                                                <p class="fs-10 mb-0 text-body-tertiary fw-semibold">
                                                                    11.13 KB</p><span
                                                                    class="fa-solid fa-circle text-body-quaternary fs-10"
                                                                    data-fa-transform="shrink-12"></span>
                                                                <p class="fs-10 mb-0 text-body-tertiary fw-semibold">
                                                                    Dec 2, 2011</p>
                                                            </div>
                                                        </div>
                                                    </a><button class="btn p-0"><span
                                                            class="fa-regular fa-arrow-alt-circle-down fs-8 text-body-tertiary"></span></button>
                                                </div>
                                            </div><a class="btn btn-link fs-10 p-0" href="#!">See 19 more <span
                                                    class="fa-solid fa-chevron-down ms-1"></span></a>
                                        </div>
                                    </div>
                                </div><button class="btn d-block p-0 fw-semibold mb-3"><span
                                        class="fa-solid fa-bell-slash me-3"></span>Mute Conversation</button><button
                                    class="btn d-block p-0 fw-semibold mb-3"><span
                                        class="fa-solid fa-gear me-3"></span>Manage Settings</button><button
                                    class="btn d-block p-0 fw-semibold mb-3"><span
                                        class="fa-solid fa-hand-holding-heart me-3"></span>Get help</button><button
                                    class="btn d-block p-0 fw-semibold mb-3"><span
                                        class="fa-solid fa-flag me-3"></span>Report Account</button><button
                                    class="btn d-block p-0 fw-semibold"><span
                                        class="fa-solid fa-ban me-3"></span>Block Account</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="phoenix-offcanvas-backdrop d-lg-none top-0" data-phoenix-backdrop="data-phoenix-backdrop">
            </div>
            <div class="modal fade" id="chatSearchBoxModal" tabindex="-1" aria-hidden="true"
                data-bs-backdrop="true" data-phoenix-modal="data-phoenix-modal"
                style="--phoenix-backdrop-opacity: 1;">
                <div class="modal-dialog">
                    <div class="modal-content mt-15">
                        <div class="modal-body p-0">
                            <div class="chat-search-box">
                                <div class="form-icon-container">
                                    <input class="form-control py-3 form-icon-input rounded-1" type="text"
                                        autofocus="autofocus" placeholder="Search People, Groups and Messages" />
                                    <span class="fa-solid fa-magnifying-glass fs-9 form-icon"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
