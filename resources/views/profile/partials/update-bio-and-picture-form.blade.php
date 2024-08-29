<form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
    @csrf
    @method('patch')

    <!-- Bio -->
    <div>
        <x-input-label for="bio" :value="__('Bio')" />
        <x-textarea id="bio" class="block mt-1 w-full" name="bio">{{ old('bio', $user->bio) }}</x-textarea>
    </div>

    <!-- Profile Picture -->
    <div class="mt-4">
        <x-input-label for="profile_picture" :value="__('Profile Picture')" />
        <input type="file" name="profile_picture" id="profile_picture" class="block mt-1 w-full" />
        @if ($user->profile_picture)
            <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="Profile Picture" class="mt-2" width="100">
        @endif
    </div>

    <div class="flex items-center justify-end mt-4">
        <x-button class="ml-4">
            {{ __('Save') }}
        </x-button>
    </div>
</form>
