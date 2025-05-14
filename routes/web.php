<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ProfileController;

Route::get('/', [RecipeController::class, 'index'])->name('home');
Route::get('/search', [RecipeController::class, 'search'])->name('search');
Route::get('/recipe/{id}', [RecipeController::class, 'show'])->name('recipe.show');

Route::middleware(['auth'])->group(function () {
    Route::get('/favorites', [FavoriteController::class, 'index'])->name('favorites');
    Route::post('/favorites', [FavoriteController::class, 'store'])->name('favorites.store');
    Route::delete('/favorites/{id}', [FavoriteController::class, 'destroy'])->name('favorites.destroy');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

Auth::routes();