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
                    @endphp

                    @foreach ($usersWithLatestMessages as $item)
                        @php
                            $user = $item['user'];
                            $latestMessage = $item['latestMessage'];
                            $hasUnreadMessages = $item['hasUnreadMessages'];
                        @endphp

                        <a href="{{ route('messages.create', $user->id) }}"
                            class="list-group-item list-group-item-action border-0 {{ isset($receiver) && $receiver->id === $user->id ? 'active' : '' }}">
                            <div class="d-flex align-items-start">
                                <img src="{{ $user->profile_picture ? asset('storage/' . $user->profile_picture) : asset('storage/profile_pictures/default-user.png') }}"
                                    class="rounded-circle me-1" alt="{{ $user->username }}" width="40"
                                    height="40">
                                <div class="flex-grow-1 ms-3">
                                    <strong>{{ $user->firstname }} {{ $user->lastname }}</strong>
                                    <p class="mb-0">
                                        @if ($latestMessage)
                                            {{ $latestMessage->sender_id === Auth::id() ? 'You: ' : '' }}{{ Str::limit($latestMessage->message, 35, '...') }}
                                            <span class="text-muted">•
                                                {{ customTimeDiff($latestMessage->created_at) }}</span>
                                        @else
                                            No messages available
                                        @endif
                                    </p>
                                </div>
                                @if (!$hasUnreadMessages)
                                    <i class="fa-solid fa-circle text-primary icon-small float-end"></i>
                                @endif
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
                                    <img src="{{ $user->profile_picture ? asset('storage/' . $user->profile_picture) : asset('storage/profile_pictures/default-user.png') }}"
                                        class="rounded-circle me-1" alt="{{ $user->username }}" width="40"
                                        height="40">
                                </div>
                                <div class="flex-grow-1 ps-3">
                                    <strong>{{ $receiver->firstname }} {{ $receiver->lastname }}</strong>
                                    {{-- <div class="text-muted small"><em>Typing...</em></div> --}}
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
                            <div class="chat-messages p-4" style="height: 60vh; overflow-y: auto;" id="chat-messages">
                                @foreach ($messages as $message)
                                    <div
                                        class="{{ $message->sender_id === $currentUser->id ? 'chat-message-right' : 'chat-message-left' }} pb-4">
                                        <div>
                                            <img src="{{ $message->sender->profile_picture ? asset('storage/' . $message->sender->profile_picture) : asset('storage/profile_pictures/default-user.png') }}"
                                                class="rounded-circle me-1" alt="{{ $message->sender->firstname }}"
                                                width="40" height="40">
                                            <div class="text-muted small text-nowrap mt-2">
                                                {{ $message->created_at->format('H:i') }}</div>
                                        </div>
                                        <div
                                            class="flex-shrink-1 {{ $message->sender_id === $currentUser->id ? 'bg-body-tertiary rounded py-2 px-3 me-3' : 'bg-body-tertiary rounded py-2 px-3 ms-3' }}">
                                            <div class="fw-bold mb-1">
                                                <a href="{{ route('profile.show', $message->sender->username) }}"
                                                    class="text-decoration-none text-dark">
                                                    {{ $message->sender->firstname }}
                                                </a>
                                            </div>
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
                                    <div class="input-group">
                                        <input type="text" name="message" id="message"
                                            class="form-control form-control-lg" required>
                                        <button type="submit" class="btn btn-primary"><i
                                                data-lucide="send-horizontal"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    @else
                        <p>Start a conversation.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const chatMessages = document.getElementById('chat-messages');
            if (chatMessages) {
                chatMessages.scrollTop = chatMessages.scrollHeight;
            }
        });
    </script>

</x-app-layout>
