@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Post</h1>
        <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="content">Content</label>
                <textarea id="content" name="content" class="form-control" required>{{ $post->content }}</textarea>
            </div>
            <div class="form-group">
                <label for="image">Image (optional)</label>
                <input type="file" id="image" name="image" class="form-control">
                @if($post->image)
                    <img src="{{ asset('storage/' . $post->image) }}" alt="Post Image" class="img-fluid mt-2">
                @endif
            </div>
            <button type="submit" class="btn btn-primary">Update Post</button>
        </form>
    </div>
@endsection
