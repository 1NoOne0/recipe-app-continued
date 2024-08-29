<?php
namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;

class RecipeController extends Controller
{
    public function index()
{
    $recipes = Recipe::with('author')->get();
    return view('recipes.index', compact('recipes'));
}


public function create(Recipe $recipe = null)
{
    return view('recipes.create', compact('recipe'));
}


public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'preparation_time' => 'required|integer',
        'meal_time' => 'nullable|string|in:breakfast,lunch,dinner',
    ]);

    // create or update?
    if ($request->has('recipe_id')) {
        $recipe = Recipe::find($request->input('recipe_id'));

        // check if author or an admin
        if ($recipe->author == auth()->user()->id || auth()->user()->hasRole('admin')) {
            $recipe->update([
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'preparation_time' => $request->input('preparation_time'),
                'meal_time' => $request->input('meal_time'),
            ]);

            return redirect()->route('recipes.show', $recipe->id)->with('success', 'Recipe updated successfully!');
        } else {
            return redirect()->route('recipes.index')->with('error', 'You are not authorized to update this recipe.');
        }
    } else {
        // Create a new recipe
        $recipe = Recipe::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'preparation_time' => $request->input('preparation_time'),
            'meal_time' => $request->input('meal_time'),
            'author' => auth()->user()->id,
        ]);

        return redirect()->route('recipes.index')->with('success', 'Recipe created successfully!');
    }
}


    public function show(Recipe $recipe)
    {
        return view('recipes.show', compact('recipe'));
    }
    public function destroy($id)
{
    $recipe = Recipe::findOrFail($id);

    // Check if the logged-in user is the author or an admin
    if (auth()->id() === $recipe->author || auth()->user()->role === 'admin') {
        $recipe->delete();
        return redirect()->route('recipes.index')->with('success', 'Recipe deleted successfully!');
    }

    return redirect()->route('recipes.index')->with('error', 'You are not authorized to delete this recipe.');
}
}
