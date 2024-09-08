@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Followers and Following</h1>
        
        <h3>Following</h3>
        <ul class="list-group">
            @foreach($following as $user)
                <li class="list-group-item">
                    {{ $user->name }}
                    <form action="{{ route('users.unfollow', $user->id) }}" method="POST" class="float-right">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Unfollow</button>
                    </form>
                </li>
            @endforeach
        </ul>

        <h3>Followers</h3>
        <ul class="list-group">
            @foreach($followers as $user)
                <li class="list-group-item">
                    {{ $user->name }}
                    <form action="{{ route('users.follow', $user->id) }}" method="POST" class="float-right">
                        @csrf
                        <button type="submit" class="btn btn-primary btn-sm">Follow</button>
                    </form>
                </li>
            @endforeach
        </ul>
    </div>
@endsection
