@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Create Post</h1>
        <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="content">Content</label>
                <textarea id="content" name="content" class="form-control" required></textarea>
            </div>
            <div class="form-group">
                <label for="image">Image (optional)</label>
                <input type="file" id="image" name="image" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Create Post</button>
        </form>
    </div>
@endsection
