<x-app-layout>
    <div class="container-fluid p-0">
        <h1 class="h3 mb-3">Messages</h1>

        <div class="card h-100">
            <div class="row g-0 h-100">
                <div class="col-12 col-lg-5 col-xl-3 border-end list-group" style="height: 75vh; overflow-y: auto;">
                    <div class="px-4 d-none d-md-block">
                        <div class="d-flex align-items-start align-items-center">
                            <div class="flex-grow-1">
                                <input type="text" class="form-control my-3" placeholder="Search...">
                            </div>
                        </div>
                    </div>

                    @foreach ($users as $user)
                        <a href="{{ route('messages.create', $user->id) }}"
                            class="list-group-item list-group-item-action border-0 {{ isset($receiver) && $receiver->id === $user->id ? 'active' : '' }}">
                            <div class="badge bg-success float-end">{{ $user->unreadMessagesCount() }}</div>
                            <div class="d-flex align-items-start">
                                <img src="{{ $user->profile_pictures ? asset('storage/profile_pictures/' . $user->profile_pictures) : asset('storage/profile_pictures/default-user.png') }}" class="rounded-circle me-1"
                                    alt="{{ $user->username }}" width="40" height="40">
                                <div class="flex-grow-1 ms-3">
                                    {{ $user->firstname }}
                                    <div class="small"><span class="fas fa-circle chat-online"></span> Online</div>
                                </div>
                            </div>
                        </a>
                    @endforeach


                    <hr class="d-block d-lg-none mt-1 mb-0" />
                </div>
                <div class="col-12 col-lg-7 col-xl-9">
                    @if (isset($receiver))
                        <div class="py-2 px-4 border-bottom d-none d-lg-block">
                            <div class="d-flex align-items-start align-items-center py-1">
                                <div class="position-relative">
                                    <img src="img/avatars/{{ $receiver->profile_picture }}" class="rounded-circle me-1"
                                        alt="{{ $receiver->name }}" width="40" height="40">
                                </div>
                                <div class="flex-grow-1 ps-3">
                                    <strong>{{ $receiver->name }}</strong>
                                    <div class="text-muted small"><em>Typing...</em></div>
                                </div>
                                <div>
                                    <button class="btn btn-primary btn-lg me-1 px-3"><i class="lucide-lg"
                                            data-lucide="phone"></i></button>
                                    <button class="btn btn-info btn-lg me-1 px-3 d-none d-md-inline-block"><i
                                            class="lucide-lg" data-lucide="video"></i></button>
                                    <button class="btn btn-light border btn-lg px-3"><i class="lucide-lg"
                                            data-lucide="more-horizontal"></i></button>
                                </div>
                            </div>
                        </div>

                        <div class="position-relative">
                            <div class="chat-messages p-4" style="height: 60vh; overflow-y: auto;">
                                @foreach ($messages as $message)
                                    <div
                                        class="{{ $message->sender_id === $currentUser->id ? 'chat-message-right' : 'chat-message-left' }} pb-4">
                                        <div>
                                            <img src="img/avatars/{{ $message->sender->profile_picture }}"
                                                class="rounded-circle me-1" alt="{{ $message->sender->name }}"
                                                width="40" height="40">
                                            <div class="text-muted small text-nowrap mt-2">
                                                {{ $message->created_at->format('H:i') }}</div>
                                        </div>
                                        <div
                                            class="flex-shrink-1 {{ $message->sender_id === $currentUser->id ? 'bg-body-tertiary rounded py-2 px-3 me-3' : 'bg-body-tertiary rounded py-2 px-3 ms-3' }}">
                                            <div class="fw-bold mb-1">{{ $message->sender->name }}</div>
                                            {{ $message->message }}
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="flex-grow-0 py-3 px-4 border-top">
                            <form action="{{ route('messages.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="receiver_id" value="{{ $receiver->id }}">
                                <div class="form-group">
                                    <label for="message">Message:</label>
                                    <textarea name="message" id="message" class="form-control" rows="4" required></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary mt-3">Send</button>
                            </form>
                        </div>
                    @else
                        <p>Select a user to start a conversation.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
