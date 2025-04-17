@extends('layouts.app')

@section('content')
  <h2>Search Recipes</h2>
  <form action="{{ route('search') }}" method="GET" class="row mb-4">
    <div class="col-md-10">
      <input type="text" name="query" class="form-control" placeholder="Search by name, category, ingredient...">
    </div>
    <div class="col-md-2">
      <button type="submit" class="btn btn-primary w-100">Search</button>
    </div>
  </form>

  @if(isset($recipes))
    <div class="row">
      @foreach($recipes as $recipe)
        <div class="col-md-4 mb-4">
          <div class="card">
            <img src="{{ $recipe['strMealThumb'] }}" class="card-img-top" alt="{{ $recipe['strMeal'] }}">
            <div class="card-body">
              <h5 class="card-title">{{ $recipe['strMeal'] }}</h5>
              <a href="{{ route('recipe.show', $recipe['idMeal']) }}" class="btn btn-sm btn-outline-primary">View Recipe</a>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  @endif
@endsection

