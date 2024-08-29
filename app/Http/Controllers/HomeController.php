<?php
namespace App\Http\Controllers;

use App\Models\Recipe;

class HomeController extends Controller
{
    public function index()
    {
        $recipes = Recipe::all();
        return view('home', compact('recipes'));
    }
}
