@extends('layouts.app')

@section('content')
  <div class="row mb-4">
    <div class="col-md-8 offset-md-2">
      <h1><i class="fas fa-edit"></i> Edit Note</h1>
      <p class="text-muted">Update your note</p>
    </div>
  </div>

  <div class="row">
    <div class="col-md-8 offset-md-2">
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

          <form method="POST" action="{{ route('notes.update', $note) }}">
            @csrf
            @method('PUT')
            
            <div class="mb-4">
              <label class="form-label"><i class="fas fa-heading"></i> Note Title</label>
              <input name="title" type="text" value="{{ old('title', $note->title) }}" class="form-control form-control-lg" placeholder="Give your note a title..." required>
            </div>

            <div class="mb-4">
              <label class="form-label"><i class="fas fa-align-left"></i> Content</label>
              <textarea name="content" class="form-control" rows="8" placeholder="Write your note here...">{{ old('content', $note->content) }}</textarea>
            </div>

            <div class="d-grid gap-2 d-md-flex justify-content-md-between">
              <a href="{{ route('notes.index') }}" class="btn btn-secondary btn-lg">
                <i class="fas fa-arrow-left me-2"></i>Cancel
              </a>
              <button type="submit" class="btn btn-primary btn-lg">
                <i class="fas fa-check me-2"></i>Update Note
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
