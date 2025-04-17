@extends('layouts.app')

@section('content')
  <h2>{{ $recipe['strMeal'] }}</h2>
  <img src="{{ $recipe['strMealThumb'] }}" class="img-fluid mb-3" style="max-width: 300px;">
  <p><strong>Category:</strong> {{ $recipe['strCategory'] }}</p>
  <p><strong>Area:</strong> {{ $recipe['strArea'] }}</p>

  <h4>Instructions:</h4>
  <p>{{ $recipe['strInstructions'] }}</p>

  @auth
    <form method="POST" action="{{ route('favorites.store') }}">
      @csrf
      <input type="hidden" name="meal_id" value="{{ $recipe['idMeal'] }}">
      <input type="hidden" name="name" value="{{ $recipe['strMeal'] }}">
      <input type="hidden" name="thumbnail" value="{{ $recipe['strMealThumb'] }}">
      <button type="submit" class="btn btn-success">Save to Favorites</button>
    </form>
  @endauth
@endsection
