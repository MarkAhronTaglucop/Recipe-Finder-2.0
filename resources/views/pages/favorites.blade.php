@extends('layouts.app')

@section('content')
<div class="favorites-page">
  <!-- Hero Section -->
  <div class="favorites-hero position-relative mb-5">
    <div class="favorites-hero-bg" style="background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.4)), url('https://images.unsplash.com/photo-1495521821757-a1efb6729352?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80'); background-size: cover; background-position: center; height: 40vh;"></div>
    <div class="container position-relative">
      <div class="row">
        <div class="col-lg-10 offset-lg-1 text-center text-white">
          <div class="hero-content-wrapper py-5">
            <h1 class="display-3 fw-bold mt-5 pt-3 favorites-title">Your Favorite Recipes</h1>
            <p class="lead mt-3">Your personal collection of delicious recipes</p>
          </div>
        </div>
      </div>
    </div>
    <div class="hero-wave">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#ffffff" fill-opacity="1" d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,122.7C672,117,768,139,864,149.3C960,160,1056,160,1152,138.7C1248,117,1344,75,1392,53.3L1440,32L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>
    </div>
  </div>

  <div class="container pb-5">
    <div class="row mb-4">
      <div class="col-12">
        <div class="d-flex justify-content-between align-items-center">
          <div class="favorites-stats">
            <span class="badge bg-dark p-2 rounded-pill">
              <i class="bi bi-heart-fill me-1"></i> {{ count($favorites) }} Saved Recipes
            </span>
          </div>
          <div class="favorites-actions">
            <div class="btn-group" role="group">
              <button type="button" class="btn btn-outline-dark active" id="grid-view-btn">
                <i class="bi bi-grid-3x3-gap-fill"></i> Grid
              </button>
              <button type="button" class="btn btn-outline-dark" id="list-view-btn">
                <i class="bi bi-list"></i> List
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>

    @if(count($favorites) > 0)
      <div class="row g-4" id="recipes-container">
        @foreach($favorites as $fav)
          <div class="col-md-6 col-lg-4 mb-4 recipe-item">
            <div class="card recipe-card border-0 rounded-4 shadow-sm hover-lift h-100">
              <div class="position-relative recipe-image-container">
                <img src="{{ $fav->thumbnail }}" class="card-img-top rounded-top-4" alt="{{ $fav->name }}">
                <div class="position-absolute top-0 end-0 m-3">
                  <form method="POST" action="{{ route('favorites.destroy', $fav->id) }}" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-dark btn-sm rounded-circle p-2 shadow-sm remove-favorite" title="Remove from favorites">
                      <i class="bi bi-heart-fill"></i>
                    </button>
                  </form>
                </div>
              </div>
              <div class="card-body p-4 d-flex flex-column">
                <h5 class="card-title fw-bold mb-auto">{{ $fav->name }}</h5>
                <div class="card-footer bg-white border-0 p-0 mt-4">
                  <a href="{{ route('recipe.show', $fav->meal_id) }}" class="btn btn-dark w-100 rounded-pill view-recipe-btn">View Recipe</a>
                </div>
              </div>
            </div>
          </div>
        @endforeach
      </div>
      
    <!--IF THERE IS NO RECIPE ADDED-->
    @else
      <div class="empty-favorites text-center py-5">
        <div class="empty-favorites-icon mb-4">
          <i class="bi bi-heart text-muted" style="font-size: 5rem;"></i>
        </div>
        <h3 class="mb-3">No Favorites Yet</h3>
        <p class="text-muted mb-4">You haven't saved any recipes to your favorites yet.</p>
        <a href="{{ route('home') }}" class="btn btn-dark rounded-pill px-4 py-2">
          <i class="bi bi-search me-2"></i> Discover Recipes
        </a>
      </div>
    @endif
  </div>
</div>

<style>
  /* Hero Section */
  .favorites-hero-bg {
    position: absolute;
    width: 100%;
    z-index: 1;
  }

  .favorites-hero {
  position: relative;
  height: 40vh;
  overflow: hidden;
}

.hero-content-wrapper {
  position: relative;
  z-index: 2;
}
  
  .hero-wave {
    position: absolute;
    left: 0;
    width: 100%;
    line-height: 1;
    z-index: 2;
  }
  
  .favorites-title {
    text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
    animation: fadeInDown 1s ease-out;
  }
  
  /* Recipe Cards */
  .recipe-card {
    transition: all 0.3s ease , box-shadow 0.3s ease;
    overflow: hidden;
  }
  
  .recipe-card img {
    transition: transform 0.5s ease;
    height: 200px;
    object-fit: cover;
  }
  
  .recipe-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 10px 20px rgba(0, 0, 0, 0.08);
}

.card-title {
  font-size: 1.1rem;
}
  
  /* Changed heart color to black/dark instead of red */
  .remove-favorite {
    transition: all 0.3s ease;
    background-color: #212529 !important; /* Dark background */
    color: white;
  }
  
  .remove-favorite:hover {
    background-color: #343a40 !important; /* Slightly lighter on hover */
    transform: scale(1.1);
  }
  
  .add-favorite {
    transition: all 0.3s ease;
  }
  
  .add-favorite:hover {
    background-color: #212529;
    color: white;
    transform: scale(1.1);
  }
  
  /* View Recipe Button Styling */
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
  
  /* List View Styling */
  .list-view .recipe-item {
    width: 100%;
  }
  
  .list-view .recipe-card {
    flex-direction: row;
    align-items: center;
  }
  
  .list-view .recipe-image-container {
    width: 200px;
    min-width: 200px;
    flex-shrink: 0;
  }
  
  .list-view .recipe-card img {
    height: 100%;
    width: 100%;
    border-radius: 0.75rem 0 0 0.75rem !important;
  }
  
  .list-view .card-body {
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
  }
  
  .list-view .card-title {
    margin-bottom: 0;
    flex: 1;
  }
  
  .list-view .card-footer {
    width: auto;
    margin-top: 0 !important;
    margin-left: auto;
    padding: 0 !important;
  }
  
  .list-view .view-recipe-btn {
    width: auto !important;
    min-width: 120px;
  }
  
  /* Responsive adjustments for list view */
  @media (max-width: 767.98px) {
    .list-view .recipe-card {
      flex-direction: column;
    }
    
    .list-view .recipe-image-container {
      width: 100%;
    }
    
    .list-view .recipe-card img {
      border-radius: 0.75rem 0.75rem 0 0 !important;
    }
    
    .list-view .card-body {
      flex-direction: column;
    }
    
    .list-view .card-title {
      margin-bottom: 1rem;
      text-align: center;
    }
    
    .list-view .card-footer {
      width: 100%;
      margin-top: 1rem !important;
    }
  }
  
  /* Empty Favorites */
  .empty-favorites {
    background-color: #f8f9fa;
    border-radius: 15px;
    padding: 50px 20px;
  }
  
  .empty-favorites-icon {
    animation: pulse 2s infinite;
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
  
  @keyframes pulse {
    0% {
      transform: scale(1);
      opacity: 1;
    }
    50% {
      transform: scale(1.1);
      opacity: 0.7;
    }
    100% {
      transform: scale(1);
      opacity: 1;
    }
  }
  
  /* Pagination */
  .pagination .page-link {
    color: #212529;
    border-radius: 50%;
    margin: 0 5px;
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
  }
  
  .pagination .page-item.active .page-link {
    background-color: #212529;
    border-color: #212529;
  }
  
  /* Section Headers */
  .section-header h2 {
    position: relative;
    display: inline-block;
    margin-bottom: 10px;
  }
  
  .section-header h2:after {
    content: '';
    position: absolute;
    width: 50px;
    height: 3px;
    background: #212529;
    bottom: -10px;
    left: 0;
  }


  .btn-outline-dark.active,
.btn-outline-dark:active,
.btn-outline-dark:focus {
  background-color: #212529;
  color: white;
  border-color: #212529;
}

#recipes-container .recipe-item {
  padding-left: 0.5rem;
  padding-right: 0.5rem;
}

</style>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Animate elements on scroll
    const animateOnScroll = function() {
      const cards = document.querySelectorAll('.recipe-card');
      
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
    const cards = document.querySelectorAll('.recipe-card');
    cards.forEach(card => {
      card.style.opacity = '0';
      card.style.transform = 'translateY(20px)';
      card.style.transition = 'all 0.5s ease';
    });
    
    // Run animation on load and scroll
    window.addEventListener('scroll', animateOnScroll);
    animateOnScroll();
    
    // Add favorite functionality
    document.querySelectorAll('.add-favorite').forEach(button => {
      button.addEventListener('click', function() {
        this.innerHTML = '<i class="bi bi-heart-fill"></i>';
        this.classList.add('text-white');
        this.classList.add('bg-dark'); // Changed from bg-danger to bg-dark
        
        // Show a toast notification
        showToast('Recipe added to favorites!');
      });
    });
    
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
    
    // Improved Grid/List view toggle
    const gridBtn = document.getElementById('grid-view-btn');
    const listBtn = document.getElementById('list-view-btn');
    const recipesContainer = document.getElementById('recipes-container');
    
    if (gridBtn && listBtn && recipesContainer) {
      listBtn.addEventListener('click', function() {
        gridBtn.classList.remove('active');
        listBtn.classList.add('active');
        
        // Change layout to list view
        recipesContainer.classList.add('list-view');
        
        // Adjust each recipe item for list view
        document.querySelectorAll('.recipe-item').forEach(item => {
          item.classList.remove('col-md-6', 'col-lg-4');
          item.classList.add('col-12');
        });
      });
      
      gridBtn.addEventListener('click', function() {
        listBtn.classList.remove('active');
        gridBtn.classList.add('active');
        
        // Change layout back to grid view
        recipesContainer.classList.remove('list-view');
        
        // Reset each recipe item for grid view
        document.querySelectorAll('.recipe-item').forEach(item => {
          item.classList.remove('col-12');
          item.classList.add('col-md-6', 'col-lg-4');
        });
      });
    }
  });
</script>
@endsection