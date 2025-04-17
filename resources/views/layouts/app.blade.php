<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Recipe Finder</title>
  <link rel="icon" href="{{ asset('egg.fried.svg') }}" type="image/svg+xml">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Add Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <style>
    :root {
      --primary-color:rgb(0, 0, 0);
      --secondary-color:rgb(255, 255, 255);
      --accent-color:rgb(255, 255, 255);
      --dark-color: #292F36;
      --light-color:rgb(0, 0, 0);
      --next-color: rgb(255, 255, 255,0); 
    }
    
    .navbar {
      background: var(--primary-color) !important;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
      padding: 15px 20px;
    }
    
    .navbar-brand {
      color: white !important;
      font-weight: 700;
      font-size: 1.5rem;
      text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);
    }
    
    .nav-link {
      color: white !important;
      font-weight: 500;
      margin: 0 5px;
      transition: all 0.3s ease;
    }
    
    .nav-link:hover {
      color: var(--accent-color) !important;
      transform: translateY(-2px);
    }
    
    .btn-auth {
      background-color: var(--secondary-color);
      color: var(--dark-color) !important;
      border: none;
      border-radius: 20px;
      padding: 8px 20px;
      font-weight: 600;
      transition: all 0.3s ease;
    }
    
    .btn-auth:hover {
      background-color: black;
      transform: translateY(-2px);
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
    }
    
    .content-container {
      /* background-color: var(--next-color); */
      
      /* box-shadow: 0 6px 105px rgba(0, 0, 0, 0.05); */
      /* border-radius: 30px; */
      /* padding: 25px; */
      height: 100vh !important; /* Adjust '80px' based on your actual navbar height */
      /* overflow-y: auto;  */
      /* margin-top: 30px; */
    }
  </style>
</head>
<body>
  @if (!isset($hideNavbar))
  <nav class="navbar navbar-expand-lg">
    <div class="container">
      <a class="navbar-brand" href="{{ url('/') }}">
        <i class="bi bi-egg-fried me-2"></i>Recipe Finder
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav">
          @auth
            <li class="nav-item">
              <a class="nav-link" href="{{ route('favorites') }}">
                <i class="bi bi-heart-fill me-1"></i>Favorites
              </a>
            </li>
            <li class="nav-item">
              <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn-auth nav-link">
                  <i class="bi bi-box-arrow-right me-1"></i>Logout
                </button>
              </form>
            </li>
          @else
            <li class="nav-item">
              <a class="nav-link btn-auth ms-2" href="{{ route('login') }}">
                <i class="bi bi-person-fill me-1"></i>Login
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link btn-auth ms-2" href="{{ route('register') }}">
                <i class="bi bi-person-plus-fill me-1"></i>Register
              </a>
            </li>
          @endauth
        </ul>
      </div>
    </div>
  </nav>
  @endif

  <div class="container">
    <div class="content-container">
      @yield('content')
    </div>
  </div>

  <!-- Add Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>