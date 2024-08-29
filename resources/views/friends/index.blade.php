@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ __('Your Friends') }}</h1>

    <!-- Feedback Messages -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <!-- Add Friend Form -->
    <form action="{{ route('friends.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <input type="email" name="friend_email" class="form-control" placeholder="{{ __('Friend\'s Email') }}" required>
        </div>
        <button type="submit" class="btn btn-primary">{{ __('Add Friend') }}</button>
    </form>

    <!-- List of Friends -->
    <div class="mt-4">
        <h2>{{ __('Friend List') }}</h2>
        @if($friends->isEmpty())
            <p>{{ __('You have no friends added yet.') }}</p>
        @else
            <ul class="list-group">
                @foreach($friends as $friend)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span>{{ $friend->username }} ({{ $friend->email }})</span>
                        <!-- Optional: Add a button to remove or view the friend -->
                        <form action="{{ route('friends.destroy', $friend->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">{{ __('Remove') }}</button>
                        </form>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>

    <!-- Incoming Friend Requests -->
    <div class="mt-4">
        <h2>{{ __('Incoming Friend Requests') }}</h2>
        @if($incomingFriends->isEmpty())
            <p>{{ __('No incoming friend requests.') }}</p>
        @else
            <ul class="list-group">
                @foreach($incomingFriends as $friend)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span>{{ $friend->username }} ({{ $friend->email }})</span>
                        <div>
                            <form action="{{ route('friends.accept', $friend->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-success btn-sm">{{ __('Accept') }}</button>
                            </form>
                            <form action="{{ route('friends.destroy', $friend->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">{{ __('Remove') }}</button>
                            </form>
                        </div>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
</div>
@endsection
