@extends('layouts.app')

@section('content')
<div class="container">
    <h1>User Management</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <!-- Edit Button -->
                        <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-primary">Edit</a>

                        <!-- Delete Button with confirmation -->
<!-- Delete Button with confirmation -->
<form id="delete-user-form-{{ $user->id }}" method="POST" style="display:inline-block;">
    @csrf
    @method('DELETE')
    <button type="button" class="btn btn-danger" onclick="deleteUser({{ $user->id }}); return false;">
        Delete
    </button>
</form>

<script>
function deleteUser(userId) {
    if (confirm('Are you sure you want to delete this user?')) {
        let form = document.getElementById('delete-user-form-' + userId);
        let formData = new FormData(form);
        
        fetch('{{ route('admin.users.destroy', '') }}/' + userId, {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => {
            if (response.ok) {
                location.reload(); // Reload the page after successful deletion
            } else {
                alert('Error deleting user');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while trying to delete the user.');
        });
    }
}
</script>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
