<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Favorite;

class FavoriteController extends Controller
{
    public function index()
    {
        $favorites = Auth::user()->favorites;
        return view('pages.favorites', compact('favorites'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'meal_id' => 'required',
            'name' => 'required',
            'thumbnail' => 'required',
        ]);

        Favorite::firstOrCreate([
            'user_id' => Auth::id(),
            'meal_id' => $request->meal_id,
        ], [
            'name' => $request->name,
            'thumbnail' => $request->thumbnail,
        ]);

        return redirect()->route('favorites')->with('success', 'Recipe added to favorites!');
    }

    public function destroy($id)
    {
        $favorite = Favorite::findOrFail($id);

        if ($favorite->user_id !== Auth::id()) {
            abort(403);
        }

        $favorite->delete();

        return back()->with('success', 'Removed from favorites.');
    }
}
