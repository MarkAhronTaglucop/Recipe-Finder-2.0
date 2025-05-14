<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Recipe Finder | Discover Delicious Meals</title>
  <link rel="icon" href="{{ asset('egg.fried.svg') }}" type="image/svg+xml">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Add Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <!-- Add Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Playfair+Display:wght@700;800&display=swap"
    rel="stylesheet">

  <style>
    :root {
      --primary-color: #212529;
      --secondary-color: #343a40;
      --accent-color: #ff7043;
      --text-color: #f8f9fa;
      --body-bg: #f8f9fa;
      --body-text: #212529;
      --light-color: #e9ecef;
      --dark-accent: #495057;
      --border-color: rgba(255, 255, 255, 0.1);
      --card-bg: #ffffff;
      --card-shadow: rgba(0, 0, 0, 0.1);
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Poppins', sans-serif;
      background-color: var(--body-bg);
      color: var(--body-text);
      overflow-x: hidden;
      position: relative;
    }

    /* Creative background elements */
    .bg-pattern {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-image:
        radial-gradient(circle at 10% 20%, rgba(52, 58, 64, 0.03) 0%, transparent 20%),
        radial-gradient(circle at 90% 80%, rgba(52, 58, 64, 0.03) 0%, transparent 20%),
        radial-gradient(circle at 50% 50%, rgba(52, 58, 64, 0.02) 0%, transparent 40%);
      z-index: -2;
    }

    .bg-shape {
      position: fixed;
      z-index: -1;
      opacity: 0.05;
      pointer-events: none;
    }

    .bg-shape-1 {
      top: 10%;
      left: 5%;
      width: 300px;
      height: 300px;
      border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%;
      background: var(--secondary-color);
      filter: blur(40px);
      animation: morphing 15s ease-in-out infinite;
    }

    .bg-shape-2 {
      bottom: 10%;
      right: 5%;
      width: 250px;
      height: 250px;
      border-radius: 60% 40% 30% 70% / 60% 30% 70% 40%;
      background: var(--accent-color);
      filter: blur(40px);
      animation: morphing 18s ease-in-out infinite reverse;
    }

    .bg-shape-3 {
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      width: 400px;
      height: 400px;
      border-radius: 53% 47% 34% 66% / 63% 46% 54% 37%;
      background: var(--primary-color);
      filter: blur(70px);
      opacity: 0.03;
      animation: pulse 20s ease-in-out infinite;
    }

    @keyframes morphing {
      0% {
        border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%;
      }

      25% {
        border-radius: 58% 42% 75% 25% / 76% 46% 54% 24%;
      }

      50% {
        border-radius: 50% 50% 33% 67% / 55% 27% 73% 45%;
      }

      75% {
        border-radius: 33% 67% 58% 42% / 63% 68% 32% 37%;
      }

      100% {
        border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%;
      }
    }

    @keyframes pulse {
      0% {
        transform: translate(-50%, -50%) scale(1);
        opacity: 0.03;
      }

      50% {
        transform: translate(-50%, -50%) scale(1.2);
        opacity: 0.05;
      }

      100% {
        transform: translate(-50%, -50%) scale(1);
        opacity: 0.03;
      }
    }

    /* Creative Navbar */
    .navbar {
      background: rgba(33, 37, 41, 0.95) !important;
      backdrop-filter: blur(10px);
      box-shadow: 0 4px 30px rgba(0, 0, 0, 0.15);
      border-bottom: 1px solid rgba(255, 255, 255, 0.05);
      padding: 15px 20px;
      position: sticky;
      top: 0;
      z-index: 1000;
    }

    .navbar-brand {
      color: var(--text-color) !important;
      font-weight: 700;
      font-size: 1.5rem;
      position: relative;
      display: flex;
      align-items: center;
    }

    .navbar-brand i {
      font-size: 1.8rem;
      margin-right: 12px;
      color: var(--accent-color);
      filter: drop-shadow(0 0 8px rgba(255, 112, 67, 0.5));
      animation: float 6s ease-in-out infinite;
      transform-origin: center;
    }

    @keyframes float {

      0%,
      100% {
        transform: translateY(0) rotate(0deg);
      }

      25% {
        transform: translateY(-5px) rotate(5deg);
      }

      75% {
        transform: translateY(5px) rotate(-5deg);
      }
    }

    .navbar-brand::after {
      content: '';
      position: absolute;
      bottom: -5px;
      left: 0;
      width: 0;
      height: 2px;
      background: var(--accent-color);
      transition: width 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
    }

    .navbar-brand:hover::after {
      width: 100%;
    }

    .nav-link {
      color: var(--text-color) !important;
      font-weight: 500;
      margin: 0 10px;
      padding: 8px 15px;
      border-radius: 8px;
      transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
      position: relative;
      z-index: 1;
    }

    .nav-link::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: var(--dark-accent);
      border-radius: 8px;
      z-index: -1;
      opacity: 0;
      transform: scale(0.9);
      transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }

    .nav-link:hover {
      color: var(--text-color) !important;
      transform: translateY(-3px);
      box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
    }

    .nav-link:hover::before {
      opacity: 1;
      transform: scale(1);
    }

    .nav-link i {
      transition: transform 0.3s ease;
    }

    .nav-link:hover i {
      transform: scale(1.2);
    }

    .btn-auth {
      background: var(--dark-accent);
      color: var(--text-color) !important;
      border: none;
      border-radius: 8px;
      padding: 10px 25px;
      font-weight: 600;
      transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
      position: relative;
      overflow: hidden;
      z-index: 1;
    }

    .btn-auth:hover {
      transform: translateY(-3px) scale(1.05);
      box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
      background: var(--secondary-color);
    }

    .navbar-toggler {
      border: none;
      background: transparent;
      padding: 0;
    }

    .navbar-toggler:focus {
      box-shadow: none;
    }

    .navbar-toggler-icon {
      background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba(255, 255, 255, 1)' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
      transition: transform 0.3s ease;
    }

    .navbar-toggler:hover .navbar-toggler-icon {
      transform: scale(1.1);
    }

    /* Creative content container */
    .content-container {
      min-height: calc(100vh - 80px);
      padding: 40px 0;
      position: relative;
      z-index: 1;
    }

    /* Card styling */
    .card {
      border: none;
      border-radius: 12px;
      overflow: hidden;
      background: var(--card-bg);
      box-shadow: 0 10px 30px var(--card-shadow);
      transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
      color: var(--body-text);
    }

    .card:hover {
      transform: translateY(-10px);
      box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
    }

    .card-img-top {
      transition: transform 0.6s ease;
    }

    .card:hover .card-img-top {
      transform: scale(1.05);
    }

    .card-title {
      color: var(--body-text);
      font-weight: 600;
    }

    .card-text {
      color: #6c757d;
    }

    /* Button styling */
    .btn-primary {
      background: var(--accent-color);
      border: none;
      border-radius: 8px;
      padding: 10px 25px;
      font-weight: 600;
      transition: all 0.3s ease;
      color: white;
    }

    .btn-primary:hover {
      transform: translateY(-3px);
      box-shadow: 0 10px 20px rgba(255, 112, 67, 0.2);
      background: #ff8a65;
    }

    .btn-outline {
      background: transparent;
      color: var(--body-text);
      border: 1px solid #dee2e6;
      border-radius: 8px;
      padding: 10px 25px;
      font-weight: 500;
      transition: all 0.3s ease;
    }

    .btn-outline:hover {
      border-color: var(--accent-color);
      color: var(--accent-color);
      transform: translateY(-3px);
      box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }

    /* Form styling */
    .form-control {
      border-radius: 8px;
      border: 1px solid #dee2e6;
      padding: 12px 15px;
      transition: all 0.3s ease;
      background-color: white;
      color: var(--body-text);
    }

    .form-control:focus {
      box-shadow: 0 0 0 3px rgba(255, 112, 67, 0.2);
      border-color: var(--accent-color);
    }

    .form-label {
      font-weight: 500;
      color: var(--body-text);
    }

    /* Search bar styling */
    .search-container {
      position: relative;
      max-width: 600px;
      margin: 0 auto 40px;
    }

    .search-container .form-control {
      padding-left: 45px;
      height: 55px;
      font-size: 1.1rem;
      box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
    }

    .search-icon {
      position: absolute;
      left: 15px;
      top: 50%;
      transform: translateY(-50%);
      color: var(--accent-color);
      font-size: 1.2rem;
    }

    /* Animated page transitions */
    .page-transition {
      animation: fadeInUp 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }

    @keyframes fadeInUp {
      from {
        opacity: 0;
        transform: translateY(30px);
      }

      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    /* Section styling */
    .section-title {
      font-family: 'Playfair Display', serif;
      font-weight: 800;
      margin-bottom: 1.5rem;
      position: relative;
      display: inline-block;
      color: var(--body-text);
    }

    .section-title::after {
      content: '';
      position: absolute;
      bottom: -10px;
      left: 0;
      width: 60px;
      height: 3px;
      background: var(--accent-color);
    }

    .section-subtitle {
      color: #6c757d;
      margin-bottom: 2rem;
    }

    /* Badge styling */
    .badge {
      padding: 6px 12px;
      border-radius: 20px;
      font-weight: 500;
      letter-spacing: 0.5px;
    }

    .badge-accent {
      background-color: var(--accent-color);
      color: white;
    }

    /* Responsive adjustments */
    @media (max-width: 991.98px) {
      .navbar-collapse {
        background: rgba(33, 37, 41, 0.98);
        margin: 15px -12px 0;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        animation: slideDown 0.3s ease-out forwards;
      }

      @keyframes slideDown {
        from {
          opacity: 0;
          transform: translateY(-20px);
        }

        to {
          opacity: 1;
          transform: translateY(0);
        }
      }

      .nav-link {
        margin: 8px 0;
      }

      .btn-auth {
        margin: 8px 0;
        display: inline-block;
      }
    }

    /* Scrollbar styling */
    ::-webkit-scrollbar {
      width: 8px;
    }

    ::-webkit-scrollbar-track {
      background: #f1f1f1;
    }

    ::-webkit-scrollbar-thumb {
      background: #adb5bd;
      border-radius: 10px;
    }

    ::-webkit-scrollbar-thumb:hover {
      background: var(--accent-color);
    }

    /* Loader animation */
    .loading-spinner {
      width: 40px;
      height: 40px;
      border: 4px solid rgba(255, 112, 67, 0.2);
      border-radius: 50%;
      border-top-color: var(--accent-color);
      animation: spin 1s ease-in-out infinite;
    }

    @keyframes spin {
      to {
        transform: rotate(360deg);
      }
    }

    /* Favorite button */
    .btn-favorite {
      position: absolute;
      top: 15px;
      right: 15px;
      background: rgba(255, 255, 255, 0.8);
      border: none;
      width: 40px;
      height: 40px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: all 0.3s ease;
      z-index: 10;
    }

    .btn-favorite:hover {
      background: white;
      transform: scale(1.1);
    }

    .btn-favorite i {
      color: #6c757d;
      font-size: 1.2rem;
      transition: all 0.3s ease;
    }

    .btn-favorite.active i {
      color: var(--accent-color);
    }

    /* Footer styling */
    footer {
      background: var(--primary-color);
      border-top: 1px solid var(--border-color);
      color: var(--text-color);
    }

    footer h5 {
      color: var(--text-color);
      font-weight: 600;
    }

    footer p {
      color: rgba(255, 255, 255, 0.7);
    }

    footer .social-links a {
      color: var(--text-color);
      transition: all 0.3s ease;
      margin-right: 15px;
    }

    footer .social-links a:hover {
      color: var(--accent-color);
      transform: translateY(-3px);
    }

    footer .social-links i {
      font-size: 1.5rem;
    }
  </style>
</head>

<body>
  <!-- Background pattern and shapes for visual interest -->
  <div class="bg-pattern"></div>
  <div class="bg-shape bg-shape-1"></div>
  <div class="bg-shape bg-shape-2"></div>
  <div class="bg-shape bg-shape-3"></div>

  @if (!isset($hideNavbar))
    <nav class="navbar navbar-expand-lg">
    <div class="container">
      <a class="navbar-brand" href="{{ url('/') }}">
      <i class="bi bi-egg-fried"></i>Recipe Finder
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
      <ul class="navbar-nav align-items-center">
        <li class="nav-item">
        <a class="nav-link" href="{{ url('/') }}">
          <i class="bi bi-house-fill me-1"></i>Home
        </a>
        </li>
        @auth
      <li class="nav-item">
      <a class="nav-link" href="{{ route('favorites') }}">
        <i class="bi bi-heart-fill me-1"></i>Favorites
      </a>
      </li>
      <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
        aria-expanded="false">
        <i class="bi bi-person-circle me-1"></i>{{ Auth::user()->name }}
      </a>
      <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown"
        style="background: var(--primary-color); border: 1px solid var(--border-color);">
        <li>
        <a href="{{ route('profile.edit') }}" class="dropdown-item text-light">
        <i class="bi bi-pencil-square me-1"></i>Edit Profile
        </a>
        </li>
        <li>
        <hr class="dropdown-divider" style="border-color: var(--border-color);">
        </li>
        <li>
        <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="dropdown-item text-light">
        <i class="bi bi-box-arrow-right me-1"></i>Logout
        </button>
        </form>
        </li>
      </ul>
      </li>
      @else
      <li class="nav-item">
      <a class="nav-link" href="{{ route('login') }}">
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

  <div class="container page-transition">
    <div class="content-container">
      @yield('content')
    </div>
  </div>

  <!-- Footer -->
  @unless (Request::is('login') || Request::is('register'))
    <footer class="py-4 mt-5">
    <div class="container">
      <div class="row g-4">
      <div class="col-md-4">
        <h5 class="mb-3">Recipe Finder</h5>
        <p class="mb-0">Discover delicious recipes from around the world.</p>
      </div>
      <div class="col-md-4">
        <h5 class="mb-3">Developers</h5>
        <ul class="list-unstyled">
        <li>
          <a href="https://www.facebook.com/kurtchintaaaaaaa" target="_blank"
          class="text-decoration-none text-light opacity-75">
          Kurt Reserva
          </a>
        </li>
        <li>
          <a href="https://www.facebook.com/markahron.taglucop01" target="_blank"
          class="text-decoration-none text-light opacity-75">
          Mark Ahron Taglucop
          </a>
        </li>
        <li>
          <a href="https://www.facebook.com/profile.php?id=61570025041214" target="_blank"
          class="text-decoration-none text-light opacity-75">
          Marc Bashley Ybiernas
          </a>
        </li>
        <li>
          <a href="https://www.facebook.com/angel.sabrido" target="_blank"
          class="text-decoration-none text-light opacity-75">
          Lawrence Sabrido
          </a>
        </li>
        <li>
          <a href="https://www.facebook.com/louisrafael11" target="_blank"
          class="text-decoration-none text-light opacity-75">
          Louis Rafael Quinones
          </a>
        </li>
        </ul>
      </div>
      <div class="col-md-4">
        <h5 class="mb-3">Connect With Us</h5>
        <div class="social-links mb-3">
        <a href="#"><i class="bi bi-facebook"></i></a>
        <a href="#"><i class="bi bi-instagram"></i></a>
        <a href="#"><i class="bi bi-twitter-x"></i></a>
        <a href="#"><i class="bi bi-pinterest"></i></a>
        </div>
        <p class="mb-0">© {{ date('Y') }} Recipe Finder. All rights reserved.</p>
      </div>
      </div>
    </div>
    </footer>
  @endunless

  <!-- Add Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  <!-- Custom JS for animations and interactions -->
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      // Animate navbar items on load
      const navItems = document.querySelectorAll('.nav-item');
      navItems.forEach((item, index) => {
        item.style.opacity = '0';
        item.style.transform = 'translateY(-20px)';
        item.style.transition = 'all 0.4s ease';
        item.style.transitionDelay = `${index * 0.1}s`;

        setTimeout(() => {
          item.style.opacity = '1';
          item.style.transform = 'translateY(0)';
        }, 100);
      });

      // Add hover effect to navbar brand
      const brand = document.querySelector('.navbar-brand');
      if (brand) {
        const icon = brand.querySelector('i');
        if (icon) {
          brand.addEventListener('mouseenter', function () {
            icon.style.transform = 'rotate(20deg) scale(1.2)';
            icon.style.transition = 'all 0.3s ease';
          });

          brand.addEventListener('mouseleave', function () {
            icon.style.transform = '';
          });
        }
      }

      // Smooth scroll for anchor links
      document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
          const target = document.querySelector(this.getAttribute('href'));
          if (target) {
            e.preventDefault();
            window.scrollTo({
              top: target.offsetTop - 100,
              behavior: 'smooth'
            });
          }
        });
      });

      // Add parallax effect to background shapes
      window.addEventListener('scroll', function () {
        const scrollPosition = window.scrollY;
        const shapes = document.querySelectorAll('.bg-shape');

        shapes.forEach((shape, index) => {
          const speed = 0.05 * (index + 1);
          shape.style.transform = `translateY(${scrollPosition * speed}px)`;
        });
      });

      // Add intersection observer for fade-in animations
      const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            entry.target.classList.add('fade-in');
            observer.unobserve(entry.target);
          }
        });
      }, { threshold: 0.1 });

      // Observe all cards, sections, and other content blocks
      document.querySelectorAll('.card, section, .content-block').forEach(el => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(20px)';
        el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        observer.observe(el);
      });

      // Add fade-in class for the animation
      document.head.insertAdjacentHTML('beforeend', `
        <style>
          .fade-in {
            opacity: 1 !important;
            transform: translateY(0) !important;
          }
        </style>
      `);
    });
  </script>
</body>

</html>