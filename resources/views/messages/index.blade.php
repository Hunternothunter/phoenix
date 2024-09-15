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

                    <a href="#" class="list-group-item list-group-item-action border-0">
                        <div class="badge bg-success float-end">5</div>
                        <div class="d-flex align-items-start">
                            <img src="img/avatars/avatar-5.jpg" class="rounded-circle me-1" alt="Ashley Briggs"
                                width="40" height="40">
                            <div class="flex-grow-1 ms-3">
                                Ashley Briggs
                                <div class="small"><span class="fas fa-circle chat-online"></span> Online</div>
                            </div>
                        </div>
                    </a>
                    <a href="#" class="list-group-item list-group-item-action border-0">
                        <div class="badge bg-success float-end">2</div>
                        <div class="d-flex align-items-start">
                            <img src="img/avatars/avatar-2.jpg" class="rounded-circle me-1" alt="Carl Jenkins"
                                width="40" height="40">
                            <div class="flex-grow-1 ms-3">
                                Carl Jenkins
                                <div class="small"><span class="fas fa-circle chat-online"></span> Online</div>
                            </div>
                        </div>
                    </a>

                    <hr class="d-block d-lg-none mt-1 mb-0" />
                </div>
                <div class="col-12 col-lg-7 col-xl-9">
                    <div class="py-2 px-4 border-bottom d-none d-lg-block">
                        <div class="d-flex align-items-start align-items-center py-1">
                            <div class="position-relative">
                                <img src="img/avatars/avatar-3.jpg" class="rounded-circle me-1" alt="Bertha Martin"
                                    width="40" height="40">
                            </div>
                            <div class="flex-grow-1 ps-3">
                                <strong>Bertha Martin</strong>
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

                    <div class="position-relative ">
                        <div class="chat-messages p-4" style="height: 60vh; overflow-y: auto;">

                            <div class="chat-message-right pb-4">
                                <div>
                                    <img src="img/avatars/avatar.jpg" class="rounded-circle me-1" alt="Chris Wood"
                                        width="40" height="40">
                                    <div class="text-muted small text-nowrap mt-2">2:33 am</div>
                                </div>
                                <div class="flex-shrink-1 bg-body-tertiary rounded py-2 px-3 me-3">
                                    <div class="fw-bold mb-1">You</div>
                                    Lorem ipsum dolor sit amet, vis erat denique in, dicunt prodesset te vix.
                                </div>
                            </div>

                            <div class="chat-message-left pb-4">
                                <div>
                                    <img src="img/avatars/avatar-3.jpg" class="rounded-circle me-1"
                                        alt="Bertha Martin" width="40" height="40">
                                    <div class="text-muted small text-nowrap mt-2">2:34 am</div>
                                </div>
                                <div class="flex-shrink-1 bg-body-tertiary rounded py-2 px-3 ms-3">
                                    <div class="fw-bold mb-1">Bertha Martin</div>
                                    Sit meis deleniti eu, pri vidit meliore docendi ut, an eum erat animal commodo.
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="flex-grow-0 py-3 px-4 border-top">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Type your message">
                            <button class="btn btn-primary">Send</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>

{{-- <div class="container">
    <h1>Messages</h1>
    <a href="{{ route('messages.create') }}" class="btn btn-primary">New Message</a>
    <div class="list-group mt-3">
        @foreach ($messages as $message)
            <a href="{{ route('messages.show', $message->id) }}" class="list-group-item list-group-item-action">
                <h5>From: {{ $message->sender->name }} To: {{ $message->receiver->name }}</h5>
                <p>{{ Str::limit($message->message, 50) }}</p>
            </a>
        @endforeach
    </div>
</div> --}}
