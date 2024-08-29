@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ __('Recipes') }}</h1>

    <!-- Button to add a new recipe -->
    <div class="mb-4">
        <a href="{{ route('recipes.create') }}" class="btn btn-primary">{{ __('Add New Recipe') }}</a>
    </div>

    <!-- Display recipe cards -->
    <div class="row">
        @foreach($recipes as $recipe)
            <div class="col-md-4">
                <div class="card mb-4">
                    <!-- Placeholder for image -->
                    <img src="{{ asset('images/placeholder.png') }}" class="card-img-top" alt="{{ __('Recipe Image') }}">

                    <!-- Recipe details -->
                    <div class="card-body">
                        <h5 class="card-title">{{ $recipe->name }}</h5>
                        <p class="card-text">{{ Str::limit($recipe->description, 100) }}</p>
                        <p class="card-text"><small class="text-muted">{{ __('Preparation Time') }}: {{ $recipe->preparation_time }} {{ __('minutes') }}</small></p>
                        <p class="card-text"><small class="text-muted">{{ __('Author ID') }}: {{ $recipe->author }}</small></p>
                       <a href="{{ route('recipes.show', $recipe->id) }}" class="btn btn-secondary">{{ __('View Recipe') }}</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
