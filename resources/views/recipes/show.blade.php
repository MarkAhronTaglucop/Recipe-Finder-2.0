@extends('layouts.app')

@section('content')
<div class="recipe-detail-page">
  <!-- Recipe Hero Section -->
  <div class="recipe-hero position-relative mb-5">
    <div class="recipe-hero-bg" style="background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.4)), url('{{ $recipe['strMealThumb'] }}'); background-size: cover; background-position: center; height: 80vh;"></div>
    <div class="container position-relative">
      <div class="row">
        <div class="col-lg-10 offset-lg-1 text-center text-white">
          <div class="hero-content-wrapper py-5">
            <h1 class="display-3 fw-bold mt-5 pt- recipe-title">{{ $recipe['strMeal'] }}</h1>
            <div class="d-flex justify-content-center flex-wrap gap-3 mt-4 recipe-meta">
              @if(isset($recipe['strCategory']))
                <span class="badge-pill"><i class="bi bi-tag-fill me-2"></i> {{ $recipe['strCategory'] }}</span>
              @endif
              
              @if(isset($recipe['strArea']))
                <span class="badge-pill"><i class="bi bi-globe me-2"></i> {{ $recipe['strArea'] }}</span>
              @endif
            </div>
            
            @auth
              <div class="mt-5">
                <form method="POST" action="{{ route('favorites.store') }}" class="d-inline">
                  @csrf
                  <input type="hidden" name="meal_id" value="{{ $recipe['idMeal'] }}">
                  <input type="hidden" name="name" value="{{ $recipe['strMeal'] }}">
                  <input type="hidden" name="thumbnail" value="{{ $recipe['strMealThumb'] }}">
                  <button type="submit" class="btn btn-lg btn-gradient rounded-pill px-5 py-3 shadow-lg hover-scale">
                    <i class="bi bi-heart-fill me-2"></i> Save to Favorites
                  </button>
                </form>
              </div>
            @else
              <div class="mt-5">
                <div class="alert alert-glass d-inline-block py-3 px-4 rounded-pill shadow-lg">
                  <i class="bi bi-info-circle me-2"></i> 
                  <span>Please <a href="{{ route('login') }}" class="alert-link text-white">login</a> or <a href="{{ route('register') }}" class="alert-link text-white">register</a> to save this recipe to your favorites.</span>
                </div>
              </div>
              <div class="mt-3">
              </div>
            @endauth
          </div>
        </div>
      </div>
    </div>
    <div class="hero-wave">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#ffffff" fill-opacity="1" d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,122.7C672,117,768,139,864,149.3C960,160,1056,160,1152,138.7C1248,117,1344,75,1392,53.3L1440,32L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>
    </div>
  </div>

  <div class="container pb-5">
    <!-- Recipe Quick Info -->
    <div class="row mb-5">
      <div class="col-12">
        <div class="card border-0 shadow-lg rounded-4 p-4 recipe-info-card">
          <div class="row g-0">
            @php
              // Extract or determine recipe details
              $difficulty = isset($recipe['strDifficulty']) ? $recipe['strDifficulty'] : null;
              $servings = isset($recipe['strServings']) ? $recipe['strServings'] : null;
              $prepTime = isset($recipe['strPrepTime']) ? $recipe['strPrepTime'] : null;
              $cookTime = isset($recipe['strCookTime']) ? $recipe['strCookTime'] : null;
              
              // If difficulty is not available, try to determine from instructions complexity
              if (!$difficulty) {
                $instructionLength = strlen($recipe['strInstructions']);
                $ingredientCount = 0;
                
                for ($i = 1; $i <= 20; $i++) {
                  if (!empty($recipe['strIngredient' . $i])) {
                    $ingredientCount++;
                  }
                }
                
                if ($instructionLength < 500 && $ingredientCount < 7) {
                  $difficulty = 'Easy';
                } elseif ($instructionLength > 1000 || $ingredientCount > 12) {
                  $difficulty = 'Hard';
                } else {
                  $difficulty = 'Medium';
                }
              }
              
              // If servings not available, estimate based on recipe type
              if (!$servings) {
                if (isset($recipe['strCategory'])) {
                  $category = strtolower($recipe['strCategory']);
                  if (strpos($category, 'dessert') !== false || strpos($category, 'side') !== false) {
                    $servings = '4-6 servings';
                  } elseif (strpos($category, 'breakfast') !== false) {
                    $servings = '2-4 servings';
                  } else {
                    $servings = '4 servings';
                  }
                } else {
                  $servings = '4 servings';
                }
              }
              
              // If prep time not available, estimate based on difficulty
              if (!$prepTime) {
                if ($difficulty == 'Easy') {
                  $prepTime = '10-15 minutes';
                } elseif ($difficulty == 'Medium') {
                  $prepTime = '20-30 minutes';
                } else {
                  $prepTime = '30-45 minutes';
                }
              }
              
              // If cook time not available, estimate based on recipe type
              if (!$cookTime) {
                if (isset($recipe['strCategory'])) {
                  $category = strtolower($recipe['strCategory']);
                  if (strpos($category, 'dessert') !== false) {
                    $cookTime = '25-35 minutes';
                  } elseif (strpos($category, 'breakfast') !== false) {
                    $cookTime = '15-20 minutes';
                  } elseif (strpos($category, 'soup') !== false) {
                    $cookTime = '30-40 minutes';
                  } else {
                    $cookTime = '25-30 minutes';
                  }
                } else {
                  $cookTime = '25-30 minutes';
                }
              }
              
              // Calculate total time
              $totalTime = $prepTime . ' + ' . $cookTime;
            @endphp
            
            <div class="col-md-3 text-center py-3">
              <div class="info-icon-wrapper mb-2">
                <i class="bi bi-bar-chart-fill text-gradient fs-1"></i>
              </div>
              <h5 class="fw-bold">Difficulty</h5>
              <p class="mb-0">
                <span class="badge bg-{{ $difficulty == 'Easy' ? 'success' : ($difficulty == 'Medium' ? 'warning' : 'danger') }} rounded-pill px-3 py-2">
                  {{ $difficulty }}
                </span>
              </p>
            </div>
            
            <div class="col-md-3 text-center py-3">
              <div class="info-icon-wrapper mb-2">
                <i class="bi bi-people-fill text-gradient fs-1"></i>
              </div>
              <h5 class="fw-bold">Servings</h5>
              <p class="mb-0">{{ $servings }}</p>
            </div>
            
            <div class="col-md-3 text-center py-3">
              <div class="info-icon-wrapper mb-2">
                <i class="bi bi-clock-fill text-gradient fs-1"></i>
              </div>
              <h5 class="fw-bold">Prep Time</h5>
              <p class="mb-0">{{ $prepTime }}</p>
            </div>
            
            <div class="col-md-3 text-center py-3">
              <div class="info-icon-wrapper mb-2">
                <i class="bi bi-fire text-gradient fs-1"></i>
              </div>
              <h5 class="fw-bold">Cook Time</h5>
              <p class="mb-0">{{ $cookTime }}</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <div class="row gx-5">
      <!-- Sidebar -->
      <div class="col-lg-4 order-2 order-lg-1">
        <!-- Recipe Image -->
        <div class="sticky-top" style="top: 20px; z-index: 10;">
          <div class="card border-0 shadow-lg rounded-4 mb-4 overflow-hidden recipe-image-card">
            <img src="{{ $recipe['strMealThumb'] }}" class="img-fluid" alt="{{ $recipe['strMeal'] }}">
            <div class="card-img-overlay d-flex align-items-end p-0">
              <div class="w-100 p-3 text-white recipe-image-overlay">
                <h4 class="mb-0">{{ $recipe['strMeal'] }}</h4>
              </div>
            </div>
          </div>
          
          <!-- Tags -->
          @if(isset($recipe['strTags']) && !empty($recipe['strTags']))
            <div class="card border-0 shadow-sm rounded-4 mb-4 p-4 tags-card">
              <h4 class="mb-3 fw-bold"><i class="bi bi-tags-fill me-2 text-gradient"></i>Tags</h4>
              
              <div class="tags-container">
                @php
                  $tags = explode(',', $recipe['strTags']);
                  $tags = array_map('trim', $tags);
                @endphp
                
                @foreach($tags as $tag)
                  <a href="{{ route('search') }}?query={{ urlencode($tag) }}" class="badge bg-light text-dark text-decoration-none m-1 p-2 tag-badge">
                    #{{ $tag }}
                  </a>
                @endforeach
              </div>
            </div>
          @endif
        </div>
      </div>
      
      <!-- Main Content -->
      <div class="col-lg-8 order-1 order-lg-2">
        <!-- Ingredients -->
        <div class="card border-0 shadow-lg rounded-4 mb-5 p-4 ingredients-card">
          <div class="d-flex align-items-center mb-4">
            <div class="recipe-section-icon bg-gradient rounded-circle d-flex align-items-center justify-content-center me-3">
              <i class="bi bi-basket text-white"></i>
            </div>
            <h3 class="mb-0 fw-bold">Ingredients</h3>
          </div>
          
          <div class="row">
            @php
              $ingredients = [];
              $measures = [];
              
              // Extract ingredients and measures
              for ($i = 1; $i <= 20; $i++) {
                $ingredient = $recipe['strIngredient' . $i] ?? null;
                $measure = $recipe['strMeasure' . $i] ?? null;
                
                if (!empty($ingredient) && trim($ingredient) !== '') {
                  $ingredients[] = $ingredient;
                  $measures[] = $measure;
                }
              }
            @endphp
            
            @foreach($ingredients as $index => $ingredient)
              <div class="col-md-6 mb-3">
                <div class="d-flex align-items-center p-3 bg-light rounded-3 hover-lift ingredient-item">
                  <div class="ingredient-icon bg-white rounded-circle d-flex align-items-center justify-content-center me-3 shadow-sm">
                    <i class="bi bi-check2 text-gradient"></i>
                  </div>
                  <div>
                    <h6 class="mb-0 fw-bold">{{ $ingredient }}</h6>
                    <small class="text-muted">{{ $measures[$index] }}</small>
                  </div>
                </div>
              </div>
            @endforeach
          </div>
        </div>
        
        <!-- Instructions -->
        <div class="card border-0 shadow-lg rounded-4 mb-5 p-4 instructions-card">
          <div class="d-flex align-items-center mb-4">
            <div class="recipe-section-icon bg-gradient rounded-circle d-flex align-items-center justify-content-center me-3">
              <i class="bi bi-list-ol text-white"></i>
            </div>
            <h3 class="mb-0 fw-bold">Step by Step Instructions</h3>
          </div>
          
          @php
            // Split instructions into steps
            $instructions = $recipe['strInstructions'];
            $steps = preg_split('/\.\s+/', $instructions);
            // Remove empty steps
            $steps = array_filter($steps, function($step) {
              return trim($step) !== '';
            });
            // Add period back to each step if it doesn't end with one
            $steps = array_map(function($step) {
              $step = trim($step);
              if (substr($step, -1) !== '.') {
                $step .= '.';
              }
              return $step;
            }, $steps);
          @endphp
          
          <div class="steps-container">
            @foreach($steps as $index => $step)
              <div class="step-item mb-4 hover-lift">
                <div class="d-flex">
                  <div class="step-number bg-gradient rounded-circle d-flex align-items-center justify-content-center me-3 shadow">
                    <span class="text-white fw-bold">{{ $index + 1 }}</span>
                  </div>
                  <div class="step-content p-4 bg-light rounded-4 flex-grow-1">
                    <p class="mb-0 step-text">{{ $step }}</p>
                  </div>
                </div>
              </div>
            @endforeach
          </div>
        </div>
        
        <!-- Video Tutorial -->
        @if(isset($recipe['strYoutube']) && !empty($recipe['strYoutube']))
          <div class="card border-0 shadow-lg rounded-4 mb-4 p-4 video-card">
            <div class="d-flex align-items-center mb-3">
              <div class="recipe-section-icon bg-gradient rounded-circle d-flex align-items-center justify-content-center me-3">
                <i class="bi bi-play-btn text-white"></i>
              </div>
              <h3 class="mb-0 fw-bold">Video Tutorial</h3>
            </div>
            
            <div class="video-container ratio ratio-16x9 rounded-4 overflow-hidden shadow">
              @php
                // Extract YouTube video ID
                $videoUrl = $recipe['strYoutube'];
                $videoId = '';
                
                if (preg_match('/(?:youtube\.com\/(?:[^\/\n\s]+\/\S+\/|(?:v|e(?:mbed)?)\/|\S*?[?&]v=)|youtu\.be\/)([a-zA-Z0-9_-]{11})/', $videoUrl, $matches)) {
                  $videoId = $matches[1];
                }
              @endphp
              
              @if(!empty($videoId))
                <iframe 
                  src="https://www.youtube.com/embed/{{ $videoId }}" 
                  title="{{ $recipe['strMeal'] }} Video Tutorial" 
                  frameborder="0" 
                  allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                  allowfullscreen>
                </iframe>
              @else
                <div class="alert alert-info mb-0 d-flex align-items-center justify-content-center">
                  <i class="bi bi-info-circle me-2"></i> Video tutorial is not available for this recipe.
                </div>
              @endif
            </div>
          </div>
          
          <!-- Source Information (below video as requested) -->
          @if(isset($recipe['strSource']) && !empty($recipe['strSource']))
            <div class="card border-0 shadow-sm rounded-4 mb-4 p-4 source-card">
              <div class="d-flex align-items-center mb-3">
                <div class="recipe-section-icon bg-gradient rounded-circle d-flex align-items-center justify-content-center me-3">
                  <i class="bi bi-link-45deg text-white"></i>
                </div>
                <h3 class="mb-0 fw-bold">Source</h3>
              </div>
              
              <div class="source-container p-3 bg-light rounded-4">
                <p class="mb-0">
                  This recipe was adapted from: 
                  <a href="{{ $recipe['strSource'] }}" target="_blank" class="fw-bold text-decoration-none source-link">
                    {{ parse_url($recipe['strSource'], PHP_URL_HOST) }}
                    <i class="bi bi-box-arrow-up-right ms-1"></i>
                  </a>
                </p>
              </div>
            </div>
          @endif
        @endif
      </div>
    </div>
  </div>
</div>

<style>
  /* Custom Gradients */
  .bg-gradient {
    background: linear-gradient(45deg, #ff7e5f, #feb47b);
  }
  
  .text-gradient {
    background: linear-gradient(45deg, #ff7e5f, #feb47b);
    -webkit-background-clip: text;
    background-clip: text;
    -webkit-text-fill-color: transparent;
    display: inline-block;
  }
  
  /* Hover Effects */
  .hover-scale {
    transition: transform 0.3s ease;
  }
  
  .hover-scale:hover {
    transform: scale(1.05);
  }
  
  .hover-lift {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
  }
  
  .hover-lift:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
  }
  
  /* Recipe Hero */
  .recipe-hero {
 
  }
  
  .recipe-hero-bg {
    position: absolute;
    width: 100%;
  }
  
  .hero-wave {
    position: absolute;
    left: 0;
    width: 100%;
    line-height: 0;
  }
  
  .recipe-title {
    text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
    animation: fadeInDown 1s ease-out;
  }
  
  .recipe-meta span.badge-pill {
    display: inline-flex;
    align-items: center;
    background: rgba(255,255,255,0.2);
    padding: 8px 15px;
    border-radius: 50px;
    font-size: 1rem;
    backdrop-filter: blur(5px);
    animation: fadeInUp 1s ease-out;
    animation-delay: 0.2s;
    animation-fill-mode: both;
  }
  
  .alert-glass {
    background: rgba(255,255,255,0.2);
    backdrop-filter: blur(5px);
    border: none;
  }
  
  /* Recipe Info Card */
  .recipe-info-card {
    margin-top: -30px;
    z-index: 20;
    position: relative;
    background: white;
    transition: all 0.3s ease;
  }
  
  .recipe-info-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 30px rgba(0,0,0,0.1) !important;
  }
  
  .info-icon-wrapper {
    height: 60px;
    display: flex;
    align-items: center;
    justify-content: center;
  }
  
  /* Section Icons */
  .recipe-section-icon {
    width: 50px;
    height: 50px;
    min-width: 50px;
    box-shadow: 0 5px 15px rgba(255,126,95,0.3);
  }
  
  /* Step Items */
  .step-number {
    width: 40px;
    height: 40px;
    min-width: 40px;
    box-shadow: 0 5px 15px rgba(255,126,95,0.3);
  }
  
  .step-text {
    font-size: 1.05rem;
    line-height: 1.6;
  }
  
  /* Ingredient Icons */
  .ingredient-icon {
    width: 36px;
    height: 36px;
    min-width: 36px;
  }
  
  /* Buttons */
  .btn-gradient {
    background: linear-gradient(45deg, #ff7e5f, #feb47b);
    border: none;
    color: white;
    transition: all 0.3s ease;
    box-shadow: 0 5px 15px rgba(255,126,95,0.3);
  }
  
  .btn-gradient:hover {
    background: linear-gradient(45deg, #feb47b, #ff7e5f);
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(255,126,95,0.4);
    color: white;
  }
  
  /* Tags */
  .tag-badge {
    transition: all 0.3s ease;
    font-size: 0.9rem;
    border-radius: 50px;
    padding: 8px 15px !important;
  }
  
  .tag-badge:hover {
    background-color: #e9ecef !important;
    transform: translateY(-2px);
    box-shadow: 0 5px 10px rgba(0,0,0,0.05);
  }
  
  /* Cards */
  .ingredients-card, .instructions-card, .video-card, .tags-card, .source-card {
    transition: all 0.3s ease;
    border-radius: 15px !important;
  }
  
  .ingredients-card:hover, .instructions-card:hover, .video-card:hover, .tags-card:hover, .source-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 30px rgba(0,0,0,0.1) !important;
  }
  
  .recipe-image-card {
    position: relative;
    overflow: hidden;
    border-radius: 15px !important;
    transition: all 0.3s ease;
  }
  
  .recipe-image-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 30px rgba(0,0,0,0.15) !important;
  }
  
  .recipe-image-card img {
    transition: all 0.5s ease;
  }
  
  .recipe-image-card:hover img {
    transform: scale(1.05);
  }
  
  .recipe-image-overlay {
    background: linear-gradient(to top, rgba(0,0,0,0.7), transparent);
  }
  
  /* Ingredient Items */
  .ingredient-item {
    transition: all 0.3s ease;
    border-radius: 10px !important;
  }
  
  .ingredient-item:hover {
    background-color: #f8f9fa !important;
    transform: translateY(-3px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.05) !important;
  }
  
  /* Source Link */
  .source-link {
    color: #ff7e5f;
    transition: all 0.3s ease;
  }
  
  .source-link:hover {
    color: #feb47b;
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
</style>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
      anchor.addEventListener('click', function (e) {
        e.preventDefault();
        
        document.querySelector(this.getAttribute('href')).scrollIntoView({
          behavior: 'smooth'
        });
      });
    });
    
    // Animate elements on scroll
    const animateOnScroll = function() {
      const cards = document.querySelectorAll('.recipe-info-card, .ingredients-card, .instructions-card, .video-card, .tags-card, .source-card, .step-item');
      
      cards.forEach((card, index) => {
        const cardPosition = card.getBoundingClientRect().top;
        const screenPosition = window.innerHeight / 1.2;
        
        if (cardPosition < screenPosition) {
          setTimeout(() => {
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
          }, index * 100);
        }
      });
    };
    
    // Set initial state for animation
    const cards = document.querySelectorAll('.recipe-info-card, .ingredients-card, .instructions-card, .video-card, .tags-card, .source-card, .step-item');
    cards.forEach(card => {
      card.style.opacity = '0';
      card.style.transform = 'translateY(20px)';
      card.style.transition = 'all 0.5s ease';
    });
    
    // Run animation on load and scroll
    window.addEventListener('scroll', animateOnScroll);
    animateOnScroll();
  });
</script>
@endsection