@extends('layouts.app')

@section('content')
<div class="row justify-content-center min-vh-100 align-items-center" style="margin-top: -4rem; margin-bottom: -2rem;">
  <div class="col-md-5">
    <div class="card border-0 shadow-lg" style="border-radius: 16px; overflow: hidden;">
      <div style="background: linear-gradient(135deg, #ff6b6b 0%, #ff5252 100%); padding: 3rem 2rem; color: white; text-align: center;">
        <i class="fas fa-user-plus" style="font-size: 3rem; margin-bottom: 1rem;"></i>
        <h2 class="mb-2">Create Account</h2>
        <p class="mb-0" style="opacity: 0.9;">Join us and start managing your notes</p>
      </div>
      
      <div class="card-body p-4">
        @if($errors->any())
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-triangle me-2"></i>
            <strong>Registration Failed!</strong>
            <ul class="mb-0 ms-4 mt-2">
              @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif

        <form method="POST" action="{{ route('register.post') }}">
          @csrf
          <div class="mb-3">
            <label class="form-label"><i class="fas fa-user"></i> Full Name</label>
            <input name="name" value="{{ old('name') }}" class="form-control form-control-lg" placeholder="Your full name" required>
          </div>
          
          <div class="mb-3">
            <label class="form-label"><i class="fas fa-envelope"></i> Email Address</label>
            <input name="email" type="email" value="{{ old('email') }}" class="form-control form-control-lg" placeholder="Your email address" required>
          </div>
          
          <div class="mb-3">
            <label class="form-label"><i class="fas fa-lock"></i> Password</label>
            <input name="password" type="password" class="form-control form-control-lg" placeholder="Create a password" required>
          </div>
          
          <div class="mb-4">
            <label class="form-label"><i class="fas fa-lock"></i> Confirm Password</label>
            <input name="password_confirmation" type="password" class="form-control form-control-lg" placeholder="Confirm your password" required>
          </div>
          
          <button class="btn btn-danger btn-lg w-100 mb-3" style="background: linear-gradient(135deg, #ff6b6b 0%, #ff5252 100%);">
            <i class="fas fa-user-plus me-2"></i>Create Account
          </button>
          
          <div class="text-center">
            <p class="mb-0">Already have an account? 
              <a href="{{ route('login') }}" style="text-decoration: none; color: #ff6b6b; font-weight: 600;">
                Login here <i class="fas fa-arrow-right ms-1"></i>
              </a>
            </p>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
