@extends('layouts.app')

@section('content')
<div class="row justify-content-center min-vh-100 align-items-center" style="margin-top: -4rem; margin-bottom: -2rem;">
  <div class="col-md-5">
    <div class="card border-0 shadow-lg" style="border-radius: 16px; overflow: hidden;">
      <div style="background: linear-gradient(135deg, #6c63ff 0%, #5a4fb8 100%); padding: 3rem 2rem; color: white; text-align: center;">
        <i class="fas fa-sign-in-alt" style="font-size: 3rem; margin-bottom: 1rem;"></i>
        <h2 class="mb-2">Welcome Back!</h2>
        <p class="mb-0" style="opacity: 0.9;">Sign in to your account to continue</p>
      </div>
      
      <div class="card-body p-4">
        @if($errors->any())
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-triangle me-2"></i>
            <strong>Login Failed!</strong> {{ $errors->first() }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif

        <form method="POST" action="{{ route('login.post') }}">
          @csrf
          <div class="mb-3">
            <label class="form-label"><i class="fas fa-envelope"></i> Email Address</label>
            <input name="email" type="email" value="{{ old('email') }}" class="form-control form-control-lg" placeholder="Enter your email" required>
          </div>
          
          <div class="mb-4">
            <label class="form-label"><i class="fas fa-lock"></i> Password</label>
            <input name="password" type="password" class="form-control form-control-lg" placeholder="Enter your password" required>
          </div>
          
          <button class="btn btn-primary btn-lg w-100 mb-3">
            <i class="fas fa-sign-in-alt me-2"></i>Sign In
          </button>
          
          <div class="text-center">
            <p class="mb-0">Don't have an account? 
              <a href="{{ route('register') }}" style="text-decoration: none; color: #6c63ff; font-weight: 600;">
                Register here <i class="fas fa-arrow-right ms-1"></i>
              </a>
            </p>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
