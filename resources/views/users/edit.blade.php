@extends('layouts.app')

@section('content')
  <div class="row mb-4">
    <div class="col-md-6 offset-md-3">
      <h1><i class="fas fa-user-edit"></i> Edit User</h1>
      <p class="text-muted">Update user information</p>
    </div>
  </div>

  <div class="row">
    <div class="col-md-6 offset-md-3">
      <div class="card border-0 shadow">
        <div class="card-body p-5">
          @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <i class="fas fa-exclamation-circle me-2"></i><strong>Validation Errors!</strong>
              <ul class="mb-0 ms-4 mt-2">
                @foreach($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
              <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
          @endif

          <form method="POST" action="{{ route('users.update', $user) }}">
            @csrf
            @method('PUT')
            
            <div class="mb-4">
              <label class="form-label"><i class="fas fa-user"></i> Full Name</label>
              <input name="name" type="text" value="{{ old('name', $user->name) }}" class="form-control form-control-lg" placeholder="User's full name" required>
            </div>

            <div class="mb-4">
              <label class="form-label"><i class="fas fa-envelope"></i> Email Address</label>
              <input name="email" type="email" value="{{ old('email', $user->email) }}" class="form-control form-control-lg" placeholder="User's email" required>
            </div>

            <div class="mb-4">
              <label class="form-label"><i class="fas fa-lock"></i> Password (leave blank to keep)</label>
              <input name="password" type="password" class="form-control form-control-lg" placeholder="Leave empty to keep current password">
            </div>

            <div class="mb-4">
              <label class="form-label"><i class="fas fa-lock"></i> Confirm Password</label>
              <input name="password_confirmation" type="password" class="form-control form-control-lg" placeholder="Confirm password">
            </div>

            <div class="d-grid gap-2 d-md-flex justify-content-md-between">
              <a href="{{ route('users.index') }}" class="btn btn-secondary btn-lg">
                <i class="fas fa-arrow-left me-2"></i>Cancel
              </a>
              <button type="submit" class="btn btn-primary btn-lg">
                <i class="fas fa-check me-2"></i>Update User
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
