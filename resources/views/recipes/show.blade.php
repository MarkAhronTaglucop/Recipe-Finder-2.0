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
            <h1 class="display-3 fw-bold mt-5 pt-5 recipe-title">{{ $recipe['strMeal'] }}</h1>
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
                  <button type="submit" class="btn btn-lg btn-dark rounded-pill px-5 py-3 shadow-lg hover-scale">
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
    <div class="row gx-5">
      <!-- Sidebar -->
      <div class="col-lg-4 order-2 order-lg-1">
        <!-- QuickAction-->
      <div class="card border-0 shadow-lg rounded-4 mb-4 actions-card">
            <div class="card-header bg-dark text-white p-3 rounded-top-4">
              <h4 class="mb-0 fw-bold d-flex align-items-center">
                <i class="bi bi-lightning-fill me-2"></i>Quick Actions
              </h4>
            </div>
            <div class="card-body p-0">
              <div class="list-group list-group-flush rounded-bottom-4">
                <a href="#ingredients" class="list-group-item list-group-item-action d-flex align-items-center p-3">
                  <i class="bi bi-basket fs-4 me-3"></i>
                  <span>View Ingredients</span>
                </a>
                <a href="#instructions" class="list-group-item list-group-item-action d-flex align-items-center p-3">
                  <i class="bi bi-list-ol fs-4 me-3"></i>
                  <span>View Instructions</span>
                </a>
                @if(isset($recipe['strYoutube']) && !empty($recipe['strYoutube']))
                <a href="#video" class="list-group-item list-group-item-action d-flex align-items-center p-3">
                  <i class="bi bi-play-btn fs-4 me-3"></i>
                  <span>Watch Video</span>
                </a>
                @endif
                <button id="print-recipe" class="list-group-item list-group-item-action d-flex align-items-center p-3">
                  <i class="bi bi-printer fs-4 me-3"></i>
                  <span>Print Recipe</span>
                </button>
              </div>
            </div>
          </div>
        <!-- Recipe Image -->
        <div class="sticky-top" style="top: 20px; z-index: 10;">
          <div class="card border-0 shadow-lg rounded-4 mb-4 overflow-hidden recipe-image-card">
            <div class="recipe-image-wrapper">
              <img src="{{ $recipe['strMealThumb'] }}" class="img-fluid" alt="{{ $recipe['strMeal'] }}">
              <div class="recipe-image-overlay-top">
                <div class="recipe-bookmark">
                  <i class="bi bi-bookmark-star-fill"></i>
                </div>
              </div>
            </div>
            <div class="card-img-overlay d-flex align-items-end p-0">
              <div class="w-100 p-3 text-white recipe-image-overlay">
                <h4 class="mb-0">{{ $recipe['strMeal'] }}</h4>
              </div>
            </div>
          </div>
          <!-- Tags -->
          @if(isset($recipe['strTags']) && !empty($recipe['strTags']))
            <div class="card border-0 shadow-lg rounded-4 mb-4 tags-card">
              <div class="card-header bg-dark text-white p-3 rounded-top-4">
                <h4 class="mb-0 fw-bold d-flex align-items-center">
                  <i class="bi bi-tags-fill me-2"></i>Tags
                </h4>
              </div>
              <div class="card-body p-4">
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
            </div>
          @endif
          
  <!-- Share Recipe -->
  <div class="card border-0 shadow-lg rounded-4 mb-4 share-card">
  <div class="card-header bg-dark text-white p-3 rounded-top-4">
    <h4 class="mb-0 fw-bold d-flex align-items-center">
      <i class="bi bi-share-fill me-2"></i>Share Recipe
    </h4>
  </div>
  <div class="card-body p-4">
    <div class="d-flex justify-content-around">
      <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank" class="btn btn-light rounded-circle p-2 share-btn facebook-share">
        <i class="bi bi-facebook fs-4"></i>
      </a>
      <a href="https://www.instagram.com/" target="_blank" class="btn btn-light rounded-circle p-2 share-btn instagram-share">
        <i class="bi bi-instagram fs-4"></i>
      </a>
      <a href="https://twitter.com/intent/tweet?text=Check out this delicious {{ $recipe['strMeal'] }} recipe!&url={{ urlencode(url()->current()) }}" target="_blank" class="btn btn-light rounded-circle p-2 share-btn twitter-share">
        <i class="bi bi-x fs-4"></i>
      </a>
      <a href="https://pinterest.com/pin/create/button/?url={{ urlencode(url()->current()) }}&media={{ urlencode($recipe['strMealThumb']) }}&description=Check out this delicious {{ $recipe['strMeal'] }} recipe!" target="_blank" class="btn btn-light rounded-circle p-2 share-btn pinterest-share">
        <i class="bi bi-pinterest fs-4"></i>
      </a>
      <a href="mailto:?subject=Delicious {{ $recipe['strMeal'] }} Recipe&body=Check out this recipe: {{ url()->current() }}" class="btn btn-light rounded-circle p-2 share-btn email-share">
        <i class="bi bi-envelope-fill fs-4"></i>
      </a>
    </div>
  </div>
</div>
          
        </div>
      </div>
      <!-- Main Content -->
      <div class="col-lg-8 order-1 order-lg-2">
        <!-- Ingredients -->
        <div id="ingredients" class="card border-0 shadow-lg rounded-4 mb-5 ingredients-card">
          <div class="card-header bg-dark text-white p-4 rounded-top-4">
            <div class="d-flex align-items-center">
              <div class="recipe-section-icon bg-white rounded-circle d-flex align-items-center justify-content-center me-3">
                <i class="bi bi-basket text-dark"></i>
              </div>
              <h3 class="mb-0 fw-bold">Ingredients</h3>
            </div>
          </div>
          
          <div class="card-body p-4">
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
                  <div class="ingredient-item">
                    <div class="ingredient-content">
                      <div class="ingredient-details">
                        <h6 class="ingredient-name">{{ $ingredient }}</h6>
                        <span class="ingredient-measure">{{ $measures[$index] }}</span>
                      </div>
                      <div class="ingredient-check">
                        <input type="checkbox" id="ingredient-{{ $index }}" class="ingredient-checkbox">
                        <label for="ingredient-{{ $index }}" class="ingredient-checkmark">
                          <i class="bi bi-check2"></i>
                        </label>
                      </div>
                    </div>
                  </div>
                </div>
              @endforeach
            </div>
          </div>
        </div>
        
        <!-- Instructions --> 
<div id="instructions" class="card border-0 shadow-lg rounded-4 mb-5 instructions-card">
  <div class="card-header bg-dark text-white p-4 rounded-top-4">
    <div class="d-flex align-items-center">
      <div class="recipe-section-icon bg-white rounded-circle d-flex align-items-center justify-content-center me-3">
        <i class="bi bi-list-ol text-dark"></i>
      </div>
      <h3 class="mb-0 fw-bold">Step by Step Instructions</h3>
    </div>
  </div>
  
  <div class="card-body p-4">
    @php
      // Split instructions into steps
      $instructions = $recipe['strInstructions'];

      if (preg_match('/^\s*\d+\s*[\.:\)]\s*/m', $instructions)) {
        $steps = preg_split('/\s*\d+\s*[\.:\)]\s*/m', $instructions);
        if (empty(trim($steps[0]))) array_shift($steps);
      } else {
        $steps = preg_split('/\.\s+/', $instructions);
      }

      $steps = array_filter($steps, fn($step) => trim($step) !== '');

      $steps = array_map(function($step) {
        $step = trim($step);
        return preg_match('/[.!?]$/', $step) ? $step : $step . '.';
      }, $steps);
    @endphp

    <div class="steps-timeline">
      @foreach($steps as $index => $step)
        <div class="step-wrapper" data-step="{{ $index + 1 }}">
          <div class="step-bullet">
            <span>{{ $index + 1 }}</span>
          </div>
          <div class="step-content">
            <div class="step-header">
              <h5 class="step-title">Step {{ $index + 1 }}</h5>
              <div class="step-actions">
                <button type="button" class="btn-step-complete" title="Mark as completed" aria-pressed="false">
                  <i class="bi bi-check-circle"></i>
                </button>
              </div>
            </div>
            <p class="step-description">{{ $step }}</p>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</div>


        
        <!-- Video Tutorial -->
@if(isset($recipe['strYoutube']) && !empty($recipe['strYoutube']))
  <div id="video" class="card border-0 shadow-lg rounded-4 mb-4 p-4 video-card">
    <div class="d-flex align-items-center mb-3">
      <div class="recipe-section-icon bg-dark rounded-circle d-flex align-items-center justify-content-center me-3">
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
        <div class="recipe-section-icon bg-dark rounded-circle d-flex align-items-center justify-content-center me-3">
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

  <!--DESIGN-->

<style>
  /* Custom Colors */
  .bg-dark {
    background-color: #212529 !important;
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
  
  /* Section Icons */
  .recipe-section-icon {
    width: 50px;
    height: 50px;
    min-width: 50px;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
  }
  
  /* Cards */
  .ingredients-card, .instructions-card, .video-card, .tags-card, .source-card, .actions-card {
    transition: all 0.3s ease;
    border-radius: 15px !important;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
  }
  
  .card-header {
    border-bottom: none;
  }
  
  /* Recipe Image Card */
  .recipe-image-card {
    position: relative;
    overflow: hidden;
    border-radius: 15px !important;
    transition: all 0.3s ease;
    box-shadow: 0 15px 35px rgba(0,0,0,0.1);
  }
  
  .recipe-image-wrapper {
    position: relative;
    overflow: hidden;
  }
  
  .recipe-image-card img {
    transition: all 0.5s ease;
    width: 100%;
  }
  
  .recipe-image-card:hover img {
    transform: scale(1.05);
  }
  
  .recipe-image-overlay {
    background: linear-gradient(to top, rgba(0,0,0,0.8), transparent);
  }
  
  .recipe-image-overlay-top {
    position: absolute;
    top: 0;
    right: 0;
    padding: 15px;
    z-index: 2;
  }
  
  .recipe-bookmark {
    width: 40px;
    height: 40px;
    background: rgba(255,255,255,0.2);
    backdrop-filter: blur(5px);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.2rem;
    cursor: pointer;
    transition: all 0.3s ease;
  }
  
  .recipe-bookmark:hover {
    background: rgba(255,255,255,0.3);
    transform: scale(1.1);
  }
  
  /* Ingredient Items - Simplified as requested */
  .ingredient-item {
    background-color: #fff;
    border-radius: 12px;
    box-shadow: 0 3px 10px rgba(0,0,0,0.05);
    margin-bottom: 10px;
    transition: all 0.3s ease;
    overflow: hidden;
    border-left: 4px solid #212529;
  }
  
  .ingredient-item:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 15px rgba(0,0,0,0.1);
  }
  
  .ingredient-content {
    display: flex;
    align-items: center;
    padding: 12px 15px;
    justify-content: space-between;
  }
  
  .ingredient-details {
    flex-grow: 1;
  }
  
  .ingredient-name {
    margin-bottom: 2px;
    font-weight: 600;
    font-size: 1rem;
  }
  
  .ingredient-measure {
    color: #6c757d;
    font-size: 0.85rem;
  }
  
  .ingredient-check {
    margin-left: 10px;
  }
  
  .ingredient-checkbox {
    display: none;
  }
  
  .ingredient-checkmark {
    width: 24px;
    height: 24px;
    border-radius: 50%;
    border: 2px solid #dee2e6;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.2s ease;
    color: transparent;
  }
  
  .ingredient-checkbox:checked + .ingredient-checkmark {
    background-color: #28a745;
    border-color: #28a745;
    color: white;
  }
  
  /* Instructions - Enhanced Timeline Style */
  .steps-timeline {
    position: relative;
    padding: 20px 0;
  }
  
  .steps-timeline:before {
    content: '';
    position: absolute;
    top: 0;
    left: 24px;
    height: 100%;
    width: 4px;
    background: #212529;
    border-radius: 4px;
  }
  
  .step-wrapper {
    position: relative;
    margin-bottom: 30px;
    padding-left: 60px;
  }
  
  .step-wrapper:last-child {
    margin-bottom: 0;
  }
  
  .step-bullet {
    position: absolute;
    left: 0;
    top: 0;
    width: 50px;
    height: 50px;
    border-radius: 50%;
    background: #212529;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: bold;
    font-size: 1.2rem;
    box-shadow: 0 5px 15px rgba(0,0,0,0.3);
    z-index: 1;
  }
  
  .step-content {
    background-color: #fff;
    border-radius: 12px;
    padding: 20px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.05);
    transition: all 0.3s ease;
    border-left: 4px solid #212529;
  }
  
  .step-content:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.1);
  }
  
  .step-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 10px;
    padding-bottom: 10px;
    border-bottom: 1px dashed #e9ecef;
  }
  
  .step-title {
    margin: 0;
    font-weight: 600;
    color: #212529;
  }
  
  .step-actions {
    display: flex;
  }
  
  .btn-step-complete {
    background: none;
    border: none;
    color: #6c757d;
    font-size: 1.2rem;
    cursor: pointer;
    transition: all 0.2s ease;
  }
  
  .btn-step-complete:hover {
    color: #28a745;
    transform: scale(1.1);
  }
  
  .btn-step-complete.active {
    color: #28a745;
  }
  
  .step-description {
    margin: 0;
    line-height: 1.6;
    font-size: 1.05rem;
  }
  
  .step-wrapper.completed .step-bullet {
    background: #28a745;
  }
  
  .step-wrapper.completed .step-content {
    background-color: #f8f9fa;
    border-left: 4px solid #28a745;
  }
  
  .step-wrapper.completed .step-description {
    text-decoration: line-through;
    opacity: 0.7;
  }
  
  /* Video Card */
  .video-wrapper {
    position: relative;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 8px 20px rgba(0,0,0,0.1);
  }
  
  .timestamp-btn {
    transition: all 0.3s ease;
    border-radius: 8px;
    border: 1px solid #e9ecef;
  }
  
  .timestamp-btn:hover {
    background-color: #f8f9fa;
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.05);
    border-color: #212529;
    color: #212529;
  }
  
  /* Source Card */
  .source-container {
    background-color: #f8f9fa;
    border-radius: 12px;
    padding: 20px;
    box-shadow: 0 3px 10px rgba(0,0,0,0.05);
  }
  
  .source-link {
    color: #212529;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s ease;
  }
  
  .source-link:hover {
    color: #495057;
    text-decoration: underline;
  }
  
  /* Share Buttons */
  .share-btn {
    transition: all 0.3s ease;
    width: 50px;
    height: 50px;
    display: flex;
    align-items: center;
    justify-content: center;
  }
  
  .share-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
  }
  
  .facebook-share:hover {
    background-color: #3b5998;
    color: white;
  }
  
  .twitter-share:hover {
    background-color: #1da1f2;
    color: white;
  }
  
  .pinterest-share:hover {
    background-color: #bd081c;
    color: white;
  }
  
  .email-share:hover {
    background-color: #555;
    color: white;
  }
  
  /* Tags */
  .tag-badge {
    transition: all 0.3s ease;
    font-size: 0.9rem;
    border-radius: 50px;
    padding: 8px 15px !important;
    display: inline-block;
    margin: 0.25rem;
    background-color: #f8f9fa;
    color: #333;
    font-weight: 500;
    box-shadow: 0 2px 5px rgba(0,0,0,0.05);
  }
  
  .tag-badge:hover {
    background-color: #e9ecef !important;
    transform: translateY(-2px);
    box-shadow: 0 5px 10px rgba(0,0,0,0.05);
    color: #212529;
  }
  
  /* Quick Actions */
  .list-group-item {
    border: none;
    border-bottom: 1px solid #f1f1f1;
    transition: all 0.3s ease;
  }
  
  .list-group-item:last-child {
    border-bottom: none;
  }
  
  .list-group-item:hover {
    background-color: #f8f9fa;
    color: #212529;
  }
  
  .list-group-item i {
    color: #212529;
  }


  .instagram-share:hover {
  background: linear-gradient(45deg, #405DE6, #5851DB, #833AB4, #C13584, #E1306C, #FD1D1D);
  color: white;
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
    // Initialize tooltips if Bootstrap JS is loaded
    if (typeof bootstrap !== 'undefined') {
      var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
      var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
      });
    }

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
      const cards = document.querySelectorAll('.ingredients-card, .instructions-card, .video-card, .tags-card, .source-card, .step-wrapper');
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
    const cards = document.querySelectorAll('.ingredients-card, .instructions-card, .video-card, .tags-card, .source-card, .step-wrapper');
    cards.forEach(card => {
      card.style.opacity = '0';
      card.style.transform = 'translateY(20px)';
      card.style.transition = 'all 0.5s ease';
    });

    // Run animation on load and scroll
    window.addEventListener('scroll', animateOnScroll);
    animateOnScroll();

    // Ingredient check functionality
    document.querySelectorAll('.ingredient-checkbox').forEach(checkbox => {
      checkbox.addEventListener('change', function() {
        const ingredientItem = this.closest('.ingredient-item');
        if (this.checked) {
          ingredientItem.classList.add('completed');
          ingredientItem.style.opacity = '0.7';
          ingredientItem.querySelector('.ingredient-name').style.textDecoration = 'line-through';
        } else {
          ingredientItem.classList.remove('completed');
          ingredientItem.style.opacity = '1';
          ingredientItem.querySelector('.ingredient-name').style.textDecoration = 'none';
        }
      });
    });

    // Step completion functionality with sequential logic
document.querySelectorAll('.btn-step-complete').forEach(button => {
  button.addEventListener('click', function() {
    const currentStepWrapper = this.closest('.step-wrapper');
    const allSteps = Array.from(document.querySelectorAll('.step-wrapper'));
    const currentIndex = allSteps.indexOf(currentStepWrapper);

    // Check if all previous steps are completed
    let canComplete = true;
    for (let i = 0; i < currentIndex; i++) {
      if (!allSteps[i].classList.contains('completed')) {
        canComplete = false;
        break;
      }
    }

    if (!canComplete) {
      alert(`Please complete Step ${currentIndex} before proceeding to Step ${currentIndex + 1}.`);
      return;
    }

    // Toggle current step
    currentStepWrapper.classList.toggle('completed');
    const icon = this.querySelector('i');

    if (currentStepWrapper.classList.contains('completed')) {
      this.classList.add('active');
      this.setAttribute('aria-pressed', 'true');
      icon.classList.remove('bi-check-circle');
      icon.classList.add('bi-check-circle-fill');
    } else {
      this.classList.remove('active');
      this.setAttribute('aria-pressed', 'false');
      icon.classList.remove('bi-check-circle-fill');
      icon.classList.add('bi-check-circle');

      // Unmark all following steps
      for (let i = currentIndex + 1; i < allSteps.length; i++) {
        const nextStep = allSteps[i];
        const nextButton = nextStep.querySelector('.btn-step-complete');
        const nextIcon = nextButton.querySelector('i');

        nextStep.classList.remove('completed');
        nextButton.classList.remove('active');
        nextButton.setAttribute('aria-pressed', 'false');
        nextIcon.classList.remove('bi-check-circle-fill');
        nextIcon.classList.add('bi-check-circle');
      }
    }
  });
});

    // Video timestamp functionality
    const timestampBtns = document.querySelectorAll('.timestamp-btn');
    timestampBtns.forEach(button => {
      button.addEventListener('click', function() {
        const seconds = parseInt(this.dataset.time);
        const iframe = document.querySelector('.video-container iframe');
        if (iframe) {
          const src = iframe.src;
          if (src.indexOf('?') > -1) {
            iframe.src = src.substring(0, src.indexOf('?')) + `?start=${seconds}&autoplay=1`;
          } else {
            iframe.src = src + `?start=${seconds}&autoplay=1`;
          }
        }
      });
    });

    // Print recipe functionality
    const printRecipeBtn = document.getElementById('print-recipe');
    if (printRecipeBtn) {
      printRecipeBtn.addEventListener('click', function() {
        const recipeName = document.querySelector('.recipe-title').textContent;

        // Get ingredients
        const ingredientsList = [];
        document.querySelectorAll('.ingredient-item').forEach(item => {
          const ingredient = item.querySelector('.ingredient-name').textContent;
          const measure = item.querySelector('.ingredient-measure').textContent;
          ingredientsList.push(`${ingredient} - ${measure}`);
        });

        // Get instructions
        const instructionsList = [];
        document.querySelectorAll('.step-wrapper').forEach(step => {
          const stepNumber = step.dataset.step;
          const instruction = step.querySelector('.step-description').textContent;
          instructionsList.push(`${stepNumber}. ${instruction}`);
        });

        const printWindow = window.open('', '_blank');
        printWindow.document.write(`
          <html>
            <head>
              <title>${recipeName} - Recipe</title>
              <style>
                body { font-family: Arial, sans-serif; padding: 20px; max-width: 800px; margin: 0 auto; }
                h1 { color: #212529; text-align: center; }
                h2 { color: #212529; margin-top: 30px; border-bottom: 2px solid #212529; padding-bottom: 5px; }
                ul, ol { padding-left: 20px; }
                li { margin-bottom: 10px; line-height: 1.5; }
                .footer { margin-top: 30px; font-size: 12px; color: #777; text-align: center; }
                .recipe-meta { text-align: center; margin-bottom: 30px; color: #666; }
                .print-buttons { text-align: center; margin: 30px 0; }
                .print-button { padding: 10px 20px; background: #212529; color: white; border: none; border-radius: 30px; cursor: pointer; font-weight: bold; }
                .close-button { padding: 10px 20px; background: #6c757d; color: white; border: none; border-radius: 30px; cursor: pointer; margin-left: 10px; font-weight: bold; }
                @media print {
                  .no-print { display: none; }
                  body { font-size: 12pt; }
                  h1 { font-size: 18pt; }
                  h2 { font-size: 16pt; }
                }
              </style>
            </head>
            <body>
              <h1>${recipeName}</h1>
              <div class="recipe-meta">
                ${document.querySelector('.recipe-meta').innerHTML}
              </div>

              <h2>Ingredients</h2>
              <ul>
                ${ingredientsList.map(item => `<li>${item}</li>`).join('')}
              </ul>

              <h2>Instructions</h2>
              <ol>
                ${instructionsList.map(item => `<li>${item}</li>`).join('')}
              </ol>

              <div class="footer">Recipe from Recipe Finder</div>

              <div class="print-buttons no-print">
                <button onclick="window.print();" class="print-button">Print Recipe</button>
                <button onclick="window.close();" class="close-button">Close</button>
              </div>
            </body>
          </html>
        `);
        printWindow.document.close();
      });
    }
  });
</script>

@endsection

<!--PWEDE RANI IHAWA, OPTIONAL RANI NA FEATURES-->
<Actions>
  <Action name="Add dark mode toggle" description="Implement a dark mode toggle for the recipe page" />
  <Action name="Add recipe rating system" description="Add a star rating system for users to rate recipes" />
  <Action name="Add recipe comments" description="Add a comment section for users to discuss the recipe" />
  <Action name="Create related recipes section" description="Add a section showing similar or related recipes" />
  <Action name="Implement recipe filtering" description="Add filtering options for recipes by category, cuisine, or ingredients" />
</Actions>
