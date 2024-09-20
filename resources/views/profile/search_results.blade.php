<x-app-layout>
    <style>
        .user-item {
            border: none;
            transition: background-color 0.1s, transform 0.1s;
        }

        .user-item:hover {
            background-color: #f8f9fa;
            cursor: pointer;
        }
    </style>
    <div class="container">
        <h1>Search Results for "{{ $query }}"</h1>

        @if ($users->isEmpty())
            <p>No users found.</p>
        @else
            <ul class="list-group">
                @foreach ($users as $user)
                    <li class="list-group-item d-flex align-items-center user-item">
                        <a href="{{ route('profile.show', $user->username) }}"
                            class="text-decoration-none text-dark d-flex align-items-center w-100">
                            <img src="{{ $user->profile_pictures ? asset('storage/profile_pictures/' . $user->profile_pictures) : asset('storage/profile_pictures/default-user.png') }}"
                                alt="Profile Picture" class="rounded-circle"
                                style="width: 40px; height: 40px; margin-right: 10px;">
                            <div class="ms-2">
                                <div class="fw-bold">{{ $user->username }}</div>
                                <div class="text-muted">{{ $user->firstname }} {{ $user->lastname }}</div>
                            </div>
                        </a>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
</x-app-layout>
