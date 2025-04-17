@extends('layouts.app')

@section('content')
  <h2>Your Favorite Recipes</h2>

  <div class="row">
    @forelse($favorites as $fav)
      <div class="col-md-4 mb-4">
        <div class="card">
          <img src="{{ $fav->thumbnail }}" class="card-img-top" alt="{{ $fav->name }}">
          <div class="card-body">
            <h5 class="card-title">{{ $fav->name }}</h5>
            <form method="POST" action="{{ route('favorites.destroy', $fav->id) }}">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-danger btn-sm">Remove</button>
            </form>
          </div>
        </div>
      </div>
    @empty
      <p>You have no saved recipes yet.</p>
    @endforelse
  </div>
@endsection
