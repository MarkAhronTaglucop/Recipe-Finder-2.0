@php($hideNavbar = true)
@extends('layouts.app')

@section('content')
<div class="container-fluid p-0">
    <div class="row g-0">
        <!-- Left side with image -->
        <div class="col-md-5 d-none d-md-block">
            <div class="bg-dark h-100 d-flex flex-column justify-content-end p-5" style="background: linear-gradient(rgba(33, 37, 41, 0.8), rgba(33, 37, 41, 0.9)), url('https://images.unsplash.com/photo-1556911220-e15b29be8c8f?ixlib=rb-1.2.1&auto=format&fit=crop&w=1000&q=80'); background-size: cover; background-position: center; min-height: 50vh;">
                <div class="text-white mb-5">
                    <h2 class="fw-bold mb-3">Discover Delicious Recipes</h2>
                    <p class="lead">Find, save, and share your favorite culinary creations</p>
                </div>
                <div class="mt-auto">
                    <div class="d-flex justify-content-center">
                        <div class="mx-2 bg-transparent py-2 px-2 lead text-white">
                            <i class="bi bi-stars me-2 text-warning"></i>USE RECIPE FINDER NOW!
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Right side with form -->
        <div class="col-12 col-md-7">
            <div class="d-flex flex-column min-vh-100 bg-light p-4 p-md-5">
                <!-- Header - Dark themed like the main page navbar -->
                <div class="bg-dark text-white rounded-3 p-3 mb-4 d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-egg-fried fs-3 me-2 text-warning"></i>
                        <h3 class="mb-0">Recipe Finder</h3>
                    </div>
                    <a href="{{ url('/') }}" class="btn btn-outline-light btn-sm rounded-pill px-3">
                        <i class="bi bi-house-door-fill me-1"></i> Back to home
                    </a>
                </div>
                
                <div class="my-auto w-100">
                    <h1 class="display-5 fw-bold mb-4">{{ __('Welcome back') }}</h1>
                    <p class="text-muted mb-4">Please enter your details to access your account</p>
                    
                    <form method="POST" action="{{ route('login') }}" class="mb-4">
                        @csrf

                        <div class="mb-4">
                            <label for="email" class="form-label fw-bold">
                                <i class="bi bi-envelope-fill me-2 text-secondary"></i>{{ __('Email Address') }}
                            </label>
                            <input id="email" type="email" 
                                class="form-control form-control-lg @error('email') is-invalid @enderror" 
                                name="email" value="{{ old('email') }}" 
                                required autocomplete="email" autofocus 
                                placeholder="you@example.com">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <i class="bi bi-exclamation-circle-fill me-1"></i>
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <div class="d-flex justify-content-between align-items-center">
                                <label for="password" class="form-label fw-bold">
                                    <i class="bi bi-lock-fill me-2 text-secondary"></i>{{ __('Password') }}
                                </label>
                                @if (Route::has('password.request'))
                                    <a class="text-decoration-none small" href="{{ route('password.request') }}" style="color: #ff7043;">
                                        {{ __('Forgot Password?') }}
                                    </a>
                                @endif
                            </div>
                            <div class="input-group">
                                <input id="password" type="password" 
                                    class="form-control form-control-lg @error('password') is-invalid @enderror" 
                                    name="password" required autocomplete="current-password" 
                                    placeholder="Enter your password">
                                <span class="input-group-text cursor-pointer toggle-password">
                                    <i class="bi bi-eye-slash"></i>
                                </span>
                            </div>

                            @error('password')
                                <span class="invalid-feedback d-block" role="alert">
                                    <i class="bi bi-exclamation-circle-fill me-1"></i>
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label" for="remember">
                                    <i class="bi bi-clock-history me-1 text-secondary"></i>
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                        </div>

                        <button type="submit" class="btn w-100 py-3 mb-3" style="background-color: #343a40; color: white;">
                            <i class="bi bi-box-arrow-in-right me-2"></i>{{ __('Sign In') }}
                        </button>
                        
                        <div class="text-center">
                            <p class="mb-0">Don't have an account? 
                                <a href="{{ route('register') }}" class="text-decoration-none fw-bold" style="color: #ff7043;">Sign up</a>
                            </p>
                        </div>
                    </form>
                    
                    <div class="text-center my-4">
                        <div class="d-flex align-items-center justify-content-center gap-3">
                            <hr class="flex-grow-1">
                            <span class="text-muted">OR</span>
                            <hr class="flex-grow-1">
                        </div>
                    </div>
                    
                    <div class="d-grid gap-2">
                        <button class="btn btn-outline-secondary py-2">
                            <i class="bi bi-google me-2"></i> Continue with Google
                        </button>
                        <button class="btn btn-outline-secondary py-2">
                            <i class="bi bi-facebook me-2"></i> Continue with Facebook
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
  .cursor-pointer {
    cursor: pointer;
  }
  
  .form-control:focus {
    border-color: #ff7043;
    box-shadow: 0 0 0 0.25rem rgba(255, 112, 67, 0.25);
  }
  
  .form-check-input:checked {
    background-color: #ff7043;
    border-color: #ff7043;
  }
  
  .btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
  }
  
  .text-warning {
    color: #ff7043 !important;
  }
</style>

<script>
  document.addEventListener("DOMContentLoaded", () => {
    const togglePassword = document.querySelector(".toggle-password");
    const passwordField = document.getElementById("password");

    togglePassword.addEventListener("click", () => {
      const type = passwordField.getAttribute("type") === "password" ? "text" : "password";
      passwordField.setAttribute("type", type);
      togglePassword.querySelector("i").classList.toggle("bi-eye-slash");
      togglePassword.querySelector("i").classList.toggle("bi-eye");
    });
  });
</script>
@endsection
