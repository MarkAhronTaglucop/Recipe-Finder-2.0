@extends('layouts.app')

@section('content')
<div class="recipe-finder-home">

  @guest
  <!-- Hero Section - Enhanced with better styling -->
  <section 
    class="hero-section position-relative d-flex align-items-center" 
    style="background: linear-gradient(rgba(0,0,0,0.75), rgba(0,0,0,0.6)), url('https://images.unsplash.com/photo-1495521821757-a1efb6729352?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80'); background-size: cover; background-position: center; min-height: 80vh;"
  >
    <div class="container text-center py-5">
      <div class="row justify-content-center">
        <div class="col-lg-8">
          <div class="mb-4 logo-animation">
            <span class="bg-white d-inline-flex align-items-center justify-content-center rounded-circle" style="width: 90px; height: 90px;">
              <i class="bi bi-egg-fried text-dark" style="font-size: 3.5rem;"></i>
            </span>
          </div>

          <h1 class="display-3 fw-bold text-white hero-title mb-3">Welcome to Recipe Finder</h1>
          <p class="lead text-white hero-subtitle">Find delicious recipes based on ingredients, categories, or meal names. Start cooking something amazing!</p>

          <div class="d-flex flex-wrap justify-content-center gap-3 mt-4">
            <a href="#search-section" class="btn btn-lg btn-light px-4 py-3 fw-bold d-flex align-items-center hero-btn">
              <i class="bi bi-search me-2"></i>Start Searching
            </a>
            <a href="{{ route('register') }}" class="btn btn-lg btn-outline-light px-4 py-3 d-flex align-items-center hero-btn">
              <i class="bi bi-person-plus-fill me-2"></i>Join Now
            </a>
          </div>

          <div class="mt-5 pt-4">
            <div class="row g-4 justify-content-center">
              @foreach([
                ['icon' => 'bi-collection', 'title' => '1000+ Recipes', 'desc' => 'Explore our extensive collection'],
                ['icon' => 'bi-bookmark-heart', 'title' => 'Save Favorites', 'desc' => 'Create your personal cookbook'],
                ['icon' => 'bi-clock-history', 'title' => 'Quick & Easy', 'desc' => 'Find recipes for any schedule']
              ] as $index => $item)
              <div class="col-md-4">
                <div class="feature-card p-4 rounded-4 text-white text-center" data-delay="{{ $index * 150 }}">
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
      <svg viewBox="0 0 1440 320" xmlns="http://www.w3.org/2000/svg">
        <path fill="#ffffff" fill-opacity="1" d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,122.7C672,117,768,139,864,149.3C960,160,1056,160,1152,138.7C1248,117,1344,75,1392,53.3L1440,32L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
      </svg>
    </div>
  </section>
  @endguest

  <!-- Categories - Enhanced with better styling -->
  <section class="categories-section py-5">
    <div class="container py-4 text-center">
      <div class="section-header mb-5">
        <h2 class="display-5 fw-bold">Popular Categories</h2>
        <p class="text-muted">Explore recipes by category</p>
        <div class="section-divider mx-auto"></div>
      </div>

      <div class="row g-4 justify-content-center">
        @foreach(['Breakfast'=>'bi-egg-fried', 'Soups'=>'bi-cup-hot', 'Desserts'=>'bi-cake2', 'Vegetarian'=>'bi-flower1', 'Beverages'=>'bi-droplet', 'Grilled'=>'bi-fire'] as $label => $icon)
        <div class="col-6 col-md-4 col-lg-2">
          <div class="category-card text-center">
            <div class="category-icon-wrapper d-flex align-items-center justify-content-center mx-auto mb-3">
              <i class="bi {{ $icon }} text-white"></i>
            </div>
            <h5 class="fw-bold">{{ $label }}</h5>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </section>

  <!-- Search - Enhanced with better styling and functionality -->
  <div id="search-section" class="search-section py-5">
    <div class="container">
      <div class="row justify-content-center mb-5">
        <div class="col-lg-8 text-center">
          <div class="section-header">
            <h2 class="display-5 fw-bold">Search Recipes</h2>
            <p class="text-muted">Find exactly what you're looking for with our powerful search</p>
            <div class="section-divider mx-auto"></div>
          </div>
        </div>
      </div>

      <form id="search-form" action="{{ route('search') }}" method="GET" class="row mb-5">
        <div class="col-md-10 mb-2 mb-md-0">
          <div class="search-input-wrapper">
            <i class="bi bi-search search-icon"></i>
            <input 
              type="text" 
              id="search-input" 
              name="query" 
              class="form-control form-control-lg" 
              placeholder="Search by name, category, ingredient..." 
              required
              autocomplete="off"
            >
          </div>
        </div>
        <div class="col-md-2">
          <button 
            type="submit" 
            id="search-button" 
            class="btn btn-dark w-100 py-3 search-button"
          >
            <span>Search</span>
          </button>
        </div>
      </form>

    <!-- Recipe cards - Enhanced with better styling -->
    @if(isset($recipes))
    <div class="row g-4">
      @foreach($recipes as $recipe)
        <div class="col-md-6 col-lg-4 mb-4">
          <div class="recipe-card border-0 rounded-4 shadow-sm h-100">
            <div class="position-relative">
              <img src="{{ $recipe['strMealThumb'] }}" class="card-img-top rounded-top-4" alt="{{ $recipe['strMeal'] }}">
              
              <!-- Only show favorite button for logged in users -->
              @auth
              <div class="position-absolute top-0 end-0 m-3">
                <form method="POST" action="{{ route('favorites.store') }}" class="d-inline">
                  @csrf
                  <input type="hidden" name="meal_id" value="{{ $recipe['idMeal'] }}">
                  <input type="hidden" name="name" value="{{ $recipe['strMeal'] }}">
                  <input type="hidden" name="thumbnail" value="{{ $recipe['strMealThumb'] }}">
                  <button type="submit" class="btn btn-dark btn-sm rounded-circle p-2 shadow-sm add-favorite" title="Add to favorites">
                    <i class="bi bi-heart"></i>
                  </button>
                </form>
              </div>
              @endauth
              
              <div class="recipe-overlay">
                <a href="{{ route('recipe.show', $recipe['idMeal']) }}" class="btn btn-light btn-lg rounded-circle view-btn">
                  <i class="bi bi-eye"></i>
                </a>
              </div>
            </div>
            <div class="card-body p-4">
              <h5 class="card-title fw-bold mb-3">{{ $recipe['strMeal'] }}</h5>
              <div class="recipe-meta d-flex justify-content-start gap-3 text-muted mb-4">
              </div>
              <a href="{{ route('recipe.show', $recipe['idMeal']) }}" class="btn btn-dark w-100 rounded-pill view-recipe-btn">
                View Recipe
              </a>
            </div>
          </div>
        </div>
      @endforeach
    </div>
    @endif

    </div>
  </div>

  <!-- How It Works - Creatively Enhanced -->
  <section class="how-it-works-section py-5">
    <div class="container py-5">
      <!-- Creative header with animated underline -->
      <div class="text-center mb-5 position-relative">
        <div class="how-it-works-badge">
          <span>Simple Steps</span>
        </div>
        <h2 class="display-5 fw-bold mb-3">How It Works</h2>
        <p class="text-muted mx-auto" style="max-width: 600px;">Follow these simple steps to discover and enjoy delicious recipes</p>
        <div class="cooking-utensils-decoration"></div>
      </div>
      
      <!-- Creative process steps with animated path -->
      <div class="position-relative mt-5 pt-4">
        <div class="process-path"></div>
        
        <div class="row">
          @foreach([
            ['step' => '1', 'title' => 'Search', 'desc' => 'Find recipes by ingredients you have, cuisine type, or dish name', 'icon' => 'bi-search', 'color' => '#212529'],
            ['step' => '2', 'title' => 'Cook', 'desc' => 'Follow easy instructions and prepare meals in no time', 'icon' => 'bi-egg-fried', 'color' => '#343a40'],
            ['step' => '3', 'title' => 'Enjoy', 'desc' => 'Savor every bite and share your favorite recipes', 'icon' => 'bi-emoji-heart-eyes', 'color' => '#495057']
          ] as $index => $step)
          <div class="col-md-4 mb-4 mb-md-0">
            <div class="process-step" data-step="{{ $index + 1 }}">
              <div class="process-icon-container" style="background-color: {{ $step['color'] }}">
                <i class="bi {{ $step['icon'] }} process-icon"></i>
                <div class="process-step-number">{{ $step['step'] }}</div>
              </div>
              <div class="process-content">
                <h3 class="fw-bold mb-3">{{ $step['title'] }}</h3>
                <p class="text-muted">{{ $step['desc'] }}</p>
              </div>
            </div>
          </div>
          @endforeach
        </div>
        
        <!-- Action button -->
        <div class="text-center mt-5">
          <a href="#search-section" class="btn btn-dark btn-lg rounded-pill px-5 py-3 process-action-btn">
            <i class="bi bi-arrow-right-circle me-2"></i>
            Get Started Now
          </a>
        </div>
      </div>
    </div>
  </section>

</div>

<style>
  /* General Styles */
  .recipe-finder-home {
    overflow-x: hidden;
  }
  
  .section-header {
    margin-bottom: 2rem;
  }
  
  .section-divider {
    height: 3px;
    width: 80px;
    background: linear-gradient(90deg, #212529, #6c757d);
    margin-top: 1.5rem;
    margin-bottom: 1.5rem;
  }
  
  /* Hero Section */
  .hero-section {
    padding-top: 2rem;
  }
  
  .hero-title {
    text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
    animation: fadeInDown 1s ease-out;
  }
  
  .hero-subtitle {
    animation: fadeInUp 1s ease-out;
    text-shadow: 1px 1px 3px rgba(0,0,0,0.3);
  }
  
  .logo-animation {
    animation: pulse 2s infinite;
  }
  
  .hero-btn {
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
    z-index: 1;
    animation: fadeIn 1.5s ease-out;
  }
  
  .hero-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.2);
  }
  
  .feature-card {
    background: rgba(255,255,255,0.1);
    backdrop-filter: blur(5px);
    border: 1px solid rgba(255,255,255,0.2);
    transition: all 0.3s ease;
    transform: translateY(30px);
    opacity: 0;
    animation: fadeInUp 0.5s forwards;
    animation-delay: var(--delay, 0ms);
  }
  
  .feature-card:hover {
    background: rgba(255,255,255,0.2);
    transform: translateY(-5px);
  }
  
  /* Categories Section */
  .categories-section {
    background-color: #ffffff;
    position: relative;
  }
  
  .category-card {
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    padding: 1.5rem 0.5rem;
    border-radius: 1rem;
    cursor: pointer;
  }
  
  .category-card:hover {
    transform: translateY(-10px);
  }
  
  .category-icon-wrapper {
    width: 90px;
    height: 90px;
    background-color: #212529;
    border-radius: 50%;
    transition: all 0.3s ease;
    font-size: 2.5rem;
    position: relative;
    overflow: hidden;
  }
  
  .category-card:hover .category-icon-wrapper {
    background-color: #343a40;
    box-shadow: 0 10px 20px rgba(0,0,0,0.1);
  }
  
  .category-card:hover .category-icon-wrapper::after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: radial-gradient(circle, rgba(255,255,255,0.2) 0%, transparent 70%);
    animation: pulse 1.5s infinite;
  }
  
  /* Search Section */
  .search-section {
    background-color: #f8f9fa;
    position: relative;
  }
  
  .search-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-image: 
      radial-gradient(circle at 10% 20%, rgba(0,0,0,0.03) 0%, transparent 20%),
      radial-gradient(circle at 90% 80%, rgba(0,0,0,0.03) 0%, transparent 20%);
    z-index: 0;
  }
  
  .search-input-wrapper {
    position: relative;
    transition: all 0.3s ease;
  }
  
  .search-input-wrapper.focused {
    transform: translateY(-2px);
  }
  
  .search-icon {
    position: absolute;
    top: 50%;
    left: 20px;
    transform: translateY(-50%);
    color: #6c757d;
    font-size: 1.2rem;
    z-index: 10;
  }
  
  .search-input-wrapper input {
    padding-left: 50px;
    border-radius: 50px;
    border: 1px solid #dee2e6;
    transition: all 0.3s ease;
    height: 60px;
  }
  
  .search-input-wrapper input:focus {
    box-shadow: 0 0 0 0.25rem rgba(33, 37, 41, 0.15);
    border-color: #212529;
  }
  
  .search-button {
    border-radius: 50px;
    transition: all 0.3s ease;
    height: 60px;
    font-weight: 600;
    letter-spacing: 0.5px;
    position: relative;
    overflow: hidden;
  }
  
  .search-button:hover {
    background-color: #343a40;
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
  }
  
  .search-button:active {
    transform: translateY(0);
  }
  
  .search-button::after {
    content: '';
    position: absolute;
    width: 100%;
    height: 100%;
    top: 0;
    left: -100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.1), transparent);
    transition: all 0.3s ease;
  }
  
  .search-button:hover::after {
    left: 100%;
  }
  
  .search-button.loading {
    pointer-events: none;
    opacity: 0.8;
  }
  
  .search-button.loading span {
    visibility: hidden;
  }
  
  .search-button.loading::before {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 20px;
    height: 20px;
    margin: -10px 0 0 -10px;
    border: 2px solid rgba(255,255,255,0.3);
    border-radius: 50%;
    border-top-color: white;
    animation: spin 0.8s linear infinite;
  }
  
  @keyframes spin {
    to { transform: rotate(360deg); }
  }
  
  /* Recipe Cards */
  .recipe-card {
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    position: relative;
    overflow: hidden;
  }
  
  .recipe-card img {
    height: 220px;
    object-fit: cover;
    transition: transform 0.5s ease;
  }
  
  .recipe-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 30px rgba(0,0,0,0.1) !important;
  }
  
  .recipe-card:hover img {
    transform: scale(1.05);
  }
  
  .recipe-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.4);
    opacity: 0;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
  }
  
  .recipe-card:hover .recipe-overlay {
    opacity: 1;
  }
  
  .view-btn {
    transform: scale(0.8);
    opacity: 0;
    transition: all 0.3s ease;
  }
  
  .recipe-card:hover .view-btn {
    transform: scale(1);
    opacity: 1;
  }
  
  .view-recipe-btn {
    transition: all 0.3s ease;
    font-weight: 600;
    padding: 10px 20px;
  }
  
  .view-recipe-btn:hover {
    background-color: #343a40;
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
  }
  
  .add-favorite {
    transition: all 0.3s ease;
    background-color: #212529 !important;
    color: white;
  }
  
  .add-favorite:hover {
    background-color: #343a40 !important;
    transform: scale(1.1);
  }
  
  /* How It Works Section - Creative Enhancement */
  .how-it-works-section {
    background-color: #ffffff;
    position: relative;
    overflow: hidden;
  }
  
  .how-it-works-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-image: 
      radial-gradient(circle at 5% 10%, rgba(33, 37, 41, 0.03) 0%, transparent 15%),
      radial-gradient(circle at 95% 85%, rgba(33, 37, 41, 0.03) 0%, transparent 15%);
    z-index: 0;
  }
  
  .how-it-works-badge {
    display: inline-block;
    background-color: #f8f9fa;
    color: #212529;
    font-weight: 600;
    font-size: 0.9rem;
    padding: 0.5rem 1.5rem;
    border-radius: 50px;
    margin-bottom: 1rem;
    box-shadow: 0 3px 10px rgba(0,0,0,0.05);
    position: relative;
    overflow: hidden;
  }
  
  .how-it-works-badge::after {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
    animation: shine 3s infinite;
  }
  
  @keyframes shine {
    0% { left: -100%; }
    20% { left: 100%; }
    100% { left: 100%; }
  }
  
  .cooking-utensils-decoration {
    position: absolute;
    width: 100%;
    height: 2px;
    background: linear-gradient(90deg, transparent, #212529, transparent);
    bottom: -10px;
    left: 0;
  }
  
  .cooking-utensils-decoration::before,
  .cooking-utensils-decoration::after {
    content: '';
    position: absolute;
    width: 10px;
    height: 10px;
    border-radius: 50%;
    background-color: #212529;
    top: 50%;
    transform: translateY(-50%);
  }
  
  .cooking-utensils-decoration::before {
    left: calc(50% - 50px);
  }
  
  .cooking-utensils-decoration::after {
    right: calc(50% - 50px);
  }
  
  .process-path {
    position: absolute;
    top: 100px;
    left: 10%;
    width: 80%;
    height: 3px;
    background: linear-gradient(90deg, #212529, #495057);
    z-index: 0;
  }
  
  .process-path::before,
  .process-path::after {
    content: '';
    position: absolute;
    width: 15px;
    height: 15px;
    border-radius: 50%;
    background-color: #212529;
    top: 50%;
    transform: translateY(-50%);
  }
  
  .process-path::before {
    left: 0;
  }
  
  .process-path::after {
    right: 0;
  }
  
  .process-step {
    text-align: center;
    position: relative;
    z-index: 1;
    padding: 2rem 1rem;
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    opacity: 0;
    transform: translateY(20px);
  }
  
  .process-step[data-step="1"] {
    animation: fadeInStep 0.5s 0.2s forwards;
  }
  
  .process-step[data-step="2"] {
    animation: fadeInStep 0.5s 0.4s forwards;
  }
  
  .process-step[data-step="3"] {
    animation: fadeInStep 0.5s 0.6s forwards;
  }
  
  @keyframes fadeInStep {
    to {
      opacity: 1;
      transform: translateY(0);
    }
  }
  
  .process-step:hover {
    transform: translateY(-10px);
  }
  
  .process-icon-container {
    position: relative;
    width: 120px;
    height: 120px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    margin: 0 auto 2rem;
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
  }
  
  .process-step:hover .process-icon-container {
    box-shadow: 0 15px 35px rgba(0,0,0,0.15);
    transform: scale(1.05);
  }
  
  .process-icon {
    font-size: 3rem;
    color: white;
    transition: all 0.3s ease;
  }
  
  .process-step:hover .process-icon {
    transform: scale(1.1);
  }
  
  .process-step-number {
    position: absolute;
    top: -10px;
    right: -10px;
    width: 40px;
    height: 40px;
    background-color: white;
    color: #212529;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    font-size: 1.5rem;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    border: 2px solid #212529;
  }
  
  .process-content {
    padding: 0 1rem;
  }
  
  .process-action-btn {
    transition: all 0.3s ease;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    transform: translateY(20px);
    opacity: 0;
    animation: fadeInUp 0.5s 0.8s forwards;
  }
  
  .process-action-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.15);
  }
  
  /* Search Feedback Animations */
  @keyframes shake {
    0%, 100% { transform: translateX(0); }
    25% { transform: translateX(-5px); }
    50% { transform: translateX(5px); }
    75% { transform: translateX(-5px); }
  }
  
  .shake {
    animation: shake 0.4s ease-in-out;
  }
  
  /* Animations */
  @keyframes fadeInDown {
    from {
      opacity: 0;
      transform: translateY(-20px);
    }
    to {
      opacity: 1;
      transform: translateY(0);
    }
  }
  
  @keyframes fadeInUp {
    from {
      opacity: 0;
      transform: translateY(20px);
    }
    to {
      opacity: 1;
      transform: translateY(0);
    }
  }
  
  @keyframes fadeIn {
    from {
      opacity: 0;
    }
    to {
      opacity: 1;
    }
  }
  
  @keyframes pulse {
    0% {
      transform: scale(1);
      opacity: 1;
    }
    50% {
      transform: scale(1.05);
      opacity: 0.8;
    }
    100% {
      transform: scale(1);
      opacity: 1;
    }
  }
  
  /* Responsive Adjustments */
  @media (max-width: 767.98px) {
    .process-path {
      display: none;
    }
    
    .process-step {
      margin-bottom: 3rem;
    }
    
    .hero-section {
      min-height: 70vh;
    }
  }
</style>

@endsection

@push('styles')
<!-- Moved to app layout if not already -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
@endpush

@push('scripts')
<script>
  document.addEventListener('DOMContentLoaded', function () {
    // Smooth scroll for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(link => {
      link.addEventListener('click', function (e) {
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
          e.preventDefault();
          target.scrollIntoView({ behavior: 'smooth' });
        }
      });
    });
    
    // Animate feature cards with delay
    document.querySelectorAll('.feature-card').forEach(card => {
      const delay = card.getAttribute('data-delay') || 0;
      card.style.setProperty('--delay', delay + 'ms');
    });
    
    // Animate elements on scroll
    const animateOnScroll = function() {
      const elements = document.querySelectorAll('.recipe-card, .category-card');
      
      elements.forEach((element, index) => {
        const elementPosition = element.getBoundingClientRect().top;
        const screenPosition = window.innerHeight / 1.2;
        
        if (elementPosition < screenPosition) {
          setTimeout(() => {
            element.style.opacity = '1';
            element.style.transform = 'translateY(0)';
          }, index * 100);
        }
      });
    };
    
    // Set initial state for animation
    const elements = document.querySelectorAll('.recipe-card, .category-card');
    elements.forEach(element => {
      element.style.opacity = '0';
      element.style.transform = 'translateY(20px)';
      element.style.transition = 'all 0.5s ease';
    });
    
    // Run animation on load and scroll
    window.addEventListener('scroll', animateOnScroll);
    animateOnScroll();
    
    // Add favorite functionality
    document.querySelectorAll('.add-favorite').forEach(button => {
      button.addEventListener('click', function(e) {
        // Prevent default to handle with JS
        e.preventDefault();
        
        // Get the form
        const form = this.closest('form');
        
        // Change the heart icon
        this.innerHTML = '<i class="bi bi-heart-fill"></i>';
        
        // Show a toast notification
        showToast('Recipe added to favorites!');
        
        // Submit the form after a short delay
        setTimeout(() => {
          form.submit();
        }, 300);
      });
    });
    
    // Enhanced search functionality
    const searchForm = document.getElementById('search-form');
    const searchInput = document.getElementById('search-input');
    const searchButton = document.getElementById('search-button');
    const searchWrapper = document.querySelector('.search-input-wrapper');
    
    if (searchForm && searchInput && searchButton) {
      // Function to handle search submission
      function performSearch() {
        // Only submit if there's text in the input
        if (searchInput.value.trim() !== '') {
          // Add loading state
          searchButton.classList.add('loading');
          
          // Submit the form
          searchForm.submit();
        } else {
          // Focus on the input if it's empty
          searchInput.focus();
          
          // Add a brief shake animation to indicate it's required
          searchWrapper.classList.add('shake');
          setTimeout(() => {
            searchWrapper.classList.remove('shake');
          }, 500);
        }
      }
      
      // Handle form submission when the button is clicked
      searchButton.addEventListener('click', function(e) {
        e.preventDefault();
        performSearch();
      });
      
      // Handle form submission when Enter key is pressed in the input field
      searchInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
          e.preventDefault();
          performSearch();
        }
      });
      
      // Add focus effects
      searchInput.addEventListener('focus', function() {
        searchWrapper.classList.add('focused');
      });
      
      searchInput.addEventListener('blur', function() {
        searchWrapper.classList.remove('focused');
      });
    }
    
    // Toast notification function
    function showToast(message) {
      // Create toast element if it doesn't exist
      if (!document.getElementById('toast-notification')) {
        const toast = document.createElement('div');
        toast.id = 'toast-notification';
        toast.className = 'position-fixed bottom-0 end-0 p-3';
        toast.style.zIndex = '1050';
        toast.innerHTML = `
          <div class="toast align-items-center text-white bg-dark border-0" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
              <div class="toast-body">
                <i class="bi bi-check-circle-fill me-2"></i>
                <span id="toast-message"></span>
              </div>
              <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
          </div>
        `;
        document.body.appendChild(toast);
      }
      
      // Set message and show toast
      document.getElementById('toast-message').textContent = message;
      // Use Bootstrap toast if available, otherwise use a simple timeout
      if (typeof bootstrap !== 'undefined') {
        const toastEl = document.querySelector('.toast');
        const toast = new bootstrap.Toast(toastEl);
        toast.show();
      } else {
        const toastEl = document.querySelector('.toast');
        toastEl.classList.add('show');
        setTimeout(() => {
          toastEl.classList.remove('show');
        }, 3000);
      }
    }
  });
</script>
@endpush
