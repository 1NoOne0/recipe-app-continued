@extends('layouts.app')

@section('title', __('Edit Profile'))

@section('content')
<div class="container">
    <h2>{{ __('Edit Profile') }}</h2>

    <!-- Display success or error messages -->
    @if (session('status') === 'profile-updated')
        <div class="alert alert-success">
            {{ __('Profile updated successfully!') }}
        </div>
    @endif

    <!-- Profile Update Form -->
    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <!-- Username -->
        <div class="mb-3">
            <label for="username" class="form-label">{{ __('Username') }}</label>
            <input type="text" id="username" name="username" class="form-control" value="{{ old('username', $user->username) }}" required>
        </div>

        <!-- Email (not editable but shown) -->
        <div class="mb-3">
            <label for="email" class="form-label">{{ __('Email') }}</label>
            <input type="email" id="email" class="form-control" value="{{ $user->email }}" disabled>
        </div>

        <!-- Bio -->
        <div class="mb-3">
            <label for="bio" class="form-label">{{ __('Bio') }}</label>
            <textarea id="bio" name="bio" class="form-control">{{ old('bio', $user->bio) }}</textarea>
        </div>

        <!-- Profile Picture -->
        <div class="mb-3">
            <label for="profile_picture" class="form-label">{{ __('Profile Picture') }}</label>
            <input type="file" name="profile_picture" id="profile_picture" class="form-control">
            @if ($user->profile_picture)
                <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="{{ __('Profile Picture') }}" class="mt-2" width="100">
            @endif
        </div>

        <!-- Save Button -->
        <button type="submit" class="btn btn-primary">{{ __('Save Changes') }}</button>
    </form>

    <!-- Update Password Form -->
    <form method="POST" action="{{ route('password.update') }}" class="mt-4">
        @csrf
        @method('put')

        <h3>{{ __('Change Password') }}</h3>

        <!-- Current Password -->
        <div class="mb-3">
            <label for="current_password" class="form-label">{{ __('Current Password') }}</label>
            <input type="password" id="current_password" name="current_password" class="form-control" required>
        </div>

        <!-- New Password -->
        <div class="mb-3">
            <label for="password" class="form-label">{{ __('New Password') }}</label>
            <input type="password" id="password" name="password" class="form-control" required>
        </div>

        <!-- Confirm New Password -->
        <div class="mb-3">
            <label for="password_confirmation" class="form-label">{{ __('Confirm New Password') }}</label>
            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required>
        </div>

        <!-- Save Button -->
        <button type="submit" class="btn btn-primary">{{ __('Change Password') }}</button>
    </form>

    <!-- Delete Account Section -->
    <form method="POST" action="{{ route('profile.destroy') }}" class="mt-4">
        @csrf
        @method('delete')
        
        <h3>{{ __('Delete Account') }}</h3>
        <p>{{ __('This action cannot be undone. All your data will be permanently deleted.') }}</p>
        
        <div class="mb-3">
            <label for="password" class="form-label">{{ __('Enter Password to Confirm:') }}</label>
            <input type="password" id="password" name="password" class="form-control" required>
        </div>
        
        <button type="submit" class="btn btn-danger">{{ __('Delete Account') }}</button>
    </form>
</div>
@endsection
