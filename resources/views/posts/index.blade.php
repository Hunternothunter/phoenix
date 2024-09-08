{{-- @extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Posts</h1>
        <a href="{{ route('posts.create') }}" class="btn btn-primary">Create New Post</a>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="list-group mt-3">
            @foreach ($posts as $post)
                <div class="list-group-item">
                    <h5>{{ $post->user->name }}</h5>
                    <p>{{ $post->content }}</p>
                    @if ($post->image)
                        <img src="{{ asset('storage/' . $post->image) }}" alt="Post Image" class="img-fluid">
                    @endif
                    <a href="{{ route('posts.show', $post->id) }}" class="btn btn-info mt-2">View Post</a>
                </div>
            @endforeach
        </div>
    </div>
@endsection --}}

{{-- @extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Posts</h1>
        <a href="{{ route('posts.create') }}" class="btn btn-primary mb-3">Create New Post</a>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="list-group">
            @foreach ($posts as $post)
                <div class="list-group-item mb-3">
                    <h5 class="mb-1">{{ $post->user->name }}</h5>
                    <p class="mb-2">{{ \Illuminate\Support\Str::limit($post->content, 100) }}</p>
                    @if ($post->image)
                        <img src="{{ asset('storage/' . $post->image) }}" alt="Post Image" class="img-fluid mb-2">
                    @endif
                    <a href="{{ route('posts.show', $post->id) }}" class="btn btn-info">View Post</a>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        {{ $posts->links() }}
    </div>
@endsection --}}


<x-app-layout>
    <div class="container">
        <h1>Posts</h1>
        <a href="{{ route('posts.create') }}" class="btn btn-primary">Create New Post</a>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="list-group mt-3">
            @foreach ($posts as $post)
                <div class="list-group-item">
                    <h5>{{ $post->user->name }}</h5>
                    <p>{{ $post->content }}</p>
                    @if ($post->image)
                        <img src="{{ asset('storage/' . $post->image) }}" alt="Post Image" class="img-fluid">
                    @endif
                    <a href="{{ route('posts.show', $post->id) }}" class="btn btn-info mt-2">View Post</a>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
