<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class RecipeController extends Controller
{
    public function index()
    {
        return view('pages.home');
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        if (!$query) {
            return redirect()->route('home');
        }

        $response = Http::get("https://www.themealdb.com/api/json/v1/1/search.php?s={$query}");

        $recipes = $response->json()['meals'] ?? [];

        return view('pages.home', ['recipes' => $recipes]);
    }

    public function show($id)
    {
        $response = Http::get("https://www.themealdb.com/api/json/v1/1/lookup.php?i={$id}");

        $recipe = $response->json()['meals'][0] ?? null;

        if (!$recipe) {
            abort(404);
        }

        return view('recipes.show', ['recipe' => $recipe]);
    }
}
