@extends('layouts.app')

@section('content')
<div class="bg-white">

  @guest
  <!-- Hero Section -->
  <section 
    class="position-relative py-5 d-flex align-items-center mt-3" 
    style="background: linear-gradient(rgba(0,0,0,0.8), rgba(0,0,0,0.7)), url('https://images.unsplash.com/photo-1495521821757-a1efb6729352?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80'); background-size: cover; background-position: center; min-height: 80vh;"
  >
    <div class="container text-center py-5">
      <div class="row justify-content-center">
        <div class="col-lg-8">
        <div class="mb-4">
  <span class="bg-white d-inline-flex align-items-center justify-content-center rounded-circle" style="width: 80px; height: 80px;">
    <i class="bi bi-egg-fried text-dark" style="font-size: 3rem;"></i>
  </span>
</div>

          <h1 class="display-3 fw-bold text-white">Welcome to Recipe Finder</h1>
          <p class="lead text-white">Find delicious recipes based on ingredients, categories, or meal names. Start cooking something amazing!</p>

          <div class="d-flex flex-wrap justify-content-center gap-3 mt-4">
            <a href="#search-section" class="btn btn-lg btn-light px-4 py-3 fw-bold d-flex align-items-center">
              <i class="bi bi-search me-2"></i>Start Searching
            </a>
            <a href="{{ route('register') }}" class="btn btn-lg btn-outline-light px-4 py-3 d-flex align-items-center">
              <i class="bi bi-person-plus-fill me-2"></i>Join Now
            </a>
          </div>

          <div class="mt-5 pt-5">
            <div class="row g-4 justify-content-center">
              @foreach([
                ['icon' => 'bi-collection', 'title' => '1000+ Recipes', 'desc' => 'Explore our extensive collection'],
                ['icon' => 'bi-bookmark-heart', 'title' => 'Save Favorites', 'desc' => 'Create your personal cookbook'],
                ['icon' => 'bi-clock-history', 'title' => 'Quick & Easy', 'desc' => 'Find recipes for any schedule']
              ] as $item)
              <div class="col-md-4">
                <div class="bg-white bg-opacity-10 p-4 rounded-3 text-white text-center">
                  <i class="bi {{ $item['icon'] }} text-white mb-3" style="font-size: 2rem;"></i>
                  <h5 class="fw-bold">{{ $item['title'] }}</h5>
                  <p class="mb-0 small">{{ $item['desc'] }}</p>
                </div>
              </div>
              @endforeach
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Curved SVG Bottom -->
    <div class="position-absolute bottom-0 start-0 w-100 overflow-hidden" style="height: 70px;">
      <svg viewBox="0 0 2880 48" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M0 48h2880V0h-720C1442.5 52 720 0 720 0H0v48z" fill="#ffffff"/>
      </svg>
    </div>
  </section>
  @endguest

  <!-- Categories -->
  <section class="py-5 bg-white">
    <div class="container py-4 text-center">
      <h2 class="display-5 fw-bold">Popular Categories</h2>
      <p class="text-muted">Explore recipes by category</p>

      <div class="row g-4 justify-content-center">
        @foreach(['Breakfast'=>'bi-egg-fried', 'Soups'=>'bi-cup-hot', 'Desserts'=>'bi-cake2', 'Vegetarian'=>'bi-flower1', 'Beverages'=>'bi-droplet', 'Grilled'=>'bi-fire'] as $label => $icon)
        <div class="col-6 col-md-4 col-lg-2">
          <div class="text-center">
            <div class="bg-dark rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 80px; height: 80px;">
              <i class="bi {{ $icon }} text-white" style="font-size: 2rem;"></i>
            </div>
            <h5 class="fw-bold">{{ $label }}</h5>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </section>

  <!-- Search -->
  <div id="search-section" class="py-5 bg-light">
    <div class="container">
      <div class="row justify-content-center mb-5">
        <div class="col-lg-8 text-center">
          <h2 class="display-5 fw-bold">Search Recipes</h2>
          <p class="text-muted">Find exactly what you're looking for with our powerful search</p>
        </div>
      </div>

      <form action="{{ route('search') }}" method="GET" class="row mb-4">
        <div class="col-md-10 mb-2 mb-md-0">
          <input type="text" name="query" class="form-control form-control-lg shadow-sm" placeholder="Search by name, category, ingredient..." required>
        </div>
        <div class="col-md-2">
          <button type="submit" class="btn btn-dark w-100 py-3">
            <i class="bi bi-search me-2"></i>Search
          </button>
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

    </div>
  </div>

  <!-- How It Works -->
  <section class="py-5 bg-white">
    <div class="container py-4 text-center">
      <h2 class="display-5 fw-bold mb-5">How It Works</h2>
      <div class="row g-4">
        @foreach([
          ['step' => '1', 'title' => 'Search', 'desc' => 'Find recipes by ingredients you have, cuisine type, or dish name', 'icon' => 'bi-search'],
          ['step' => '2', 'title' => 'Cook', 'desc' => 'Follow easy instructions and prepare meals in no time', 'icon' => 'bi-egg-fried'],
          ['step' => '3', 'title' => 'Enjoy', 'desc' => 'Savor every bite and share your favorite recipes', 'icon' => 'bi-emoji-heart-eyes'],
        ] as $step)
        <div class="col-md-4">
          <div class="text-center px-4">
            <div class="bg-dark rounded-circle d-flex align-items-center justify-content-center mx-auto mb-4" style="width: 100px; height: 100px;">
              <span class="text-white fw-bold" style="font-size: 2.5rem;">{{ $step['step'] }}</span>
            </div>
            <h3 class="fw-bold mb-3">{{ $step['title'] }}</h3>
            <p class="text-muted">{{ $step['desc'] }}</p>
            <div class="mt-3"><i class="bi {{ $step['icon'] }} fs-1 text-dark"></i></div>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </section>

</div>

@endsection

@push('styles')
<!-- Moved to app layout if not already -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
@endpush

@push('scripts')
<script>
  document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('a[href^="#"]').forEach(link => {
      link.addEventListener('click', function (e) {
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
          e.preventDefault();
          target.scrollIntoView({ behavior: 'smooth' });
        }
      });
    });
  });
</script>
@endpush
