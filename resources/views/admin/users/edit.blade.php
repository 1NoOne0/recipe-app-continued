@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit User</h1>

    <!-- Display success message -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- User Edit Form -->
    <form method="POST" action="{{ route('admin.users.update', $user->id) }}">
        @csrf
        @method('PATCH')

        <!-- Username -->
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" id="username" name="username" class="form-control" value="{{ old('username', $user->username) }}" required>
        </div>

        <!-- Email -->
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" id="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
        </div>

        <!-- Bio -->
        <div class="mb-3">
            <label for="bio" class="form-label">Bio</label>
            <textarea id="bio" name="bio" class="form-control">{{ old('bio', $user->bio) }}</textarea>
        </div>

        <!-- Password (optional) -->
        <div class="mb-3">
            <label for="password" class="form-label">New Password (leave blank to keep current password)</label>
            <input type="password" id="password" name="password" class="form-control">
        </div>

        <!-- Confirm Password -->
        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirm Password</label>
            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control">
        </div>

        <!-- Save Button -->
        <button type="submit" class="btn btn-primary">Save Changes</button>
    </form>
</div>
@endsection
