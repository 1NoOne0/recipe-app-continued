@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <img src="{{ asset('images/placeholder.png') }}" class="card-img-top" alt="{{ __('Recipe Image') }}">
        <div class="card-body">
            <h5 class="card-title">{{ $recipe->name }}</h5>
            <p class="card-text">{{ $recipe->description }}</p>
            <p class="card-text"><small class="text-muted">{{ __('Preparation Time') }}: {{ $recipe->preparation_time }} {{ __('minutes') }}</small></p>
            <p class="card-text"><small class="text-muted">{{ __('Author ID') }}: {{ $recipe->author }}</small></p>

            <!-- Check if the logged-in user is the author or an admin -->
            @if (Auth::id() === $recipe->author || Auth::user()->role === 'admin')
                <a href="{{ route('recipes.create', ['recipe_id' => $recipe->id]) }}" class="btn btn-primary">{{ __('Edit Recipe') }}</a>

                <!-- Delete button with confirmation -->
                <form action="{{ route('recipes.destroy', $recipe->id) }}" method="POST" style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('{{ __('Are you sure you want to delete this recipe?') }}');">{{ __('Delete Recipe') }}</button>
                </form>
            @endif

        </div>
    </div>
</div>
@endsection
