@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ isset($recipe) ? __('Edit Recipe') : __('Create Recipe') }}</h1>

    <form method="POST" action="{{ route('recipes.store') }}">
        @csrf

        <!-- Hidden input to store the recipe ID if editing -->
        @if(isset($recipe))
            <input type="hidden" name="recipe_id" value="{{ $recipe->id }}">
        @endif

        <!-- Recipe Name -->
        <div class="mb-3">
            <label for="name" class="form-label">{{ __('Recipe Name') }}</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $recipe->name ?? '') }}" required>
        </div>

        <!-- Recipe Description -->
        <div class="mb-3">
            <label for="description" class="form-label">{{ __('Description') }}</label>
            <textarea id="description" name="description" class="form-control" required>{{ old('description', $recipe->description ?? '') }}</textarea>
        </div>

        <!-- Preparation Time -->
        <div class="mb-3">
            <label for="preparation_time" class="form-label">{{ __('Preparation Time') }}</label>
            <input type="number" id="preparation_time" name="preparation_time" class="form-control" value="{{ old('preparation_time', $recipe->preparation_time ?? '') }}" required>
        </div>

        <!-- Meal Time -->
        <div class="mb-3">
            <label for="meal_time" class="form-label">{{ __('Meal Time') }}</label>
            <select id="meal_time" name="meal_time" class="form-control">
                <option value="breakfast" {{ old('meal_time', $recipe->meal_time ?? '') == 'breakfast' ? 'selected' : '' }}>{{ __('Breakfast') }}</option>
                <option value="lunch" {{ old('meal_time', $recipe->meal_time ?? '') == 'lunch' ? 'selected' : '' }}>{{ __('Lunch') }}</option>
                <option value="dinner" {{ old('meal_time', $recipe->meal_time ?? '') == 'dinner' ? 'selected' : '' }}>{{ __('Dinner') }}</option>
            </select>
        </div>

        <!-- Save Button -->
        <button type="submit" class="btn btn-primary">{{ isset($recipe) ? __('Update Recipe') : __('Create Recipe') }}</button>
    </form>
</div>
@endsection
