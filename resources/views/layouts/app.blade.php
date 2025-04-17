<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Recipe Finder</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light px-4">
    <a class="navbar-brand" href="{{ url('/') }}">🍽 Recipe Finder</a>
    <div class="collapse navbar-collapse justify-content-end">
      <ul class="navbar-nav">
        @auth
          <li class="nav-item"><a class="nav-link" href="{{ route('favorites') }}">Favorites</a></li>
          <li class="nav-item">
            <form method="POST" action="{{ route('logout') }}">
              @csrf
              <button type="submit" class="btn btn-link nav-link">Logout</button>
            </form>
          </li>
        @else
          <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Register</a></li>
        @endauth
      </ul>
    </div>
  </nav>

  <div class="container mt-4">
    @yield('content')
  </div>
</body>
</html>

