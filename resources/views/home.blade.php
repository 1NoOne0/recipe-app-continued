@extends('layouts.app')

@section('title', __('Home'))

@section('content')
    <div class="row">
        @foreach($recipes as $recipe)
            <div class="col-md-4">
                <div class="card mb-4">
                    <img src="{{ $recipe->image_url }}" class="card-img-top" alt="{{ $recipe->name }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $recipe->name }}</h5>
                        <p class="card-text">{{ Str::limit($recipe->description, 100) }}</p>
                        <a href="{{ route('recipes.show', $recipe->id) }}" class="btn btn-primary">{{ __('View Recipe') }}</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
