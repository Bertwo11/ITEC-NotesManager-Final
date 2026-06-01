@extends('layouts.app')

@section('content')
  <div class="row mb-4">
    <div class="col-md-8">
      <h1><i class="fas fa-users"></i> Users Management</h1>
      <p class="text-muted">Manage system users</p>
    </div>
    <div class="col-md-4 text-end">
      <a href="{{ route('users.create') }}" class="btn btn-primary btn-lg">
        <i class="fas fa-user-plus me-2"></i>Add User
      </a>
    </div>
  </div>

  @if($users->isEmpty())
    <div class="card text-center p-5" style="border: 2px dashed #ddd; background: #f9f9f9;">
      <i class="fas fa-users" style="font-size: 3rem; color: #ccc; margin-bottom: 1rem;"></i>
      <h5 class="text-muted">No users found</h5>
      <p class="text-muted mb-3">Add your first user to get started</p>
      <a href="{{ route('users.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-2"></i>Add First User
      </a>
    </div>
  @else
    <div class="card border-0 shadow">
      <div class="table-responsive">
        <table class="table table-hover mb-0">
          <thead>
            <tr>
              <th class="ps-4"><i class="fas fa-user"></i> Name</th>
              <th><i class="fas fa-envelope"></i> Email</th>
              <th><i class="fas fa-calendar"></i> Joined</th>
              <th class="text-end pe-4"><i class="fas fa-cogs"></i> Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach($users as $user)
              <tr class="align-middle">
                <td class="ps-4">
                  <strong>{{ $user->name }}</strong>
                </td>
                <td>
                  <span class="text-muted">{{ $user->email }}</span>
                </td>
                <td>
                  <span class="badge bg-info">{{ $user->created_at->format('M d, Y') }}</span>
                </td>
                <td class="text-end pe-4">
                  <a href="{{ route('users.edit', $user) }}" class="btn btn-sm btn-warning me-2">
                    <i class="fas fa-edit"></i> Edit
                  </a>
                  <form action="{{ route('users.destroy', $user) }}" method="POST" style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete this user?')">
                      <i class="fas fa-trash"></i> Delete
                    </button>
                  </form>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  @endif
@endsection
