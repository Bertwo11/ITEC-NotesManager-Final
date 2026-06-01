@extends('layouts.app')

@section('content')
  <div class="row mb-4">
    <div class="col-md-8">
      <h1><i class="fas fa-file-alt"></i>
        @if(Auth::user()->isAdmin())
          All Notes
        @else
          My Notes
        @endif
      </h1>
      <p class="text-muted">
        @if(Auth::user()->isAdmin())
          Manage and view all notes from all users
        @else
          Manage and organize your notes efficiently
        @endif
      </p>
    </div>
    <div class="col-md-4 text-end">
      <a href="{{ route('notes.create') }}" class="btn btn-primary btn-lg">
        <i class="fas fa-plus-circle me-2"></i>Add Note
      </a>
    </div>
  </div>

  @if($notes->isEmpty())
    <div class="card text-center p-5" style="border: 2px dashed #ddd; background: #f9f9f9;">
      <i class="fas fa-inbox" style="font-size: 3rem; color: #ccc; margin-bottom: 1rem;"></i>
      <h5 class="text-muted">No notes yet</h5>
      <p class="text-muted mb-3">Start by creating your first note</p>
      <a href="{{ route('notes.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-2"></i>Create Your First Note
      </a>
    </div>
  @else
    <div class="card border-0 shadow">
      <div class="table-responsive">
        <table class="table table-hover mb-0">
          <thead>
            <tr>
              <th class="ps-4"><i class="fas fa-heading"></i> Title</th>
              <th><i class="fas fa-align-left"></i> Content Preview</th>
              {{-- Admin lang makakakita ng Created By column --}}
              @if(Auth::user()->isAdmin())
                <th><i class="fas fa-user"></i> Created By</th>
              @endif
              <th><i class="fas fa-calendar"></i> Created</th>
              <th class="text-end pe-4"><i class="fas fa-cogs"></i> Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach($notes as $note)
              <tr class="align-middle">
                <td class="ps-4">
                  <strong>{{ $note->title }}</strong>
                </td>
                <td>
                  <span class="text-muted small">
                    {{ Illuminate\Support\Str::limit($note->content, 80) }}
                  </span>
                </td>
                {{-- Admin lang makakakita kung sino gumawa --}}
                @if(Auth::user()->isAdmin())
                  <td>
                    <span class="badge" style="background:#EEEDFE; color:#534AB7;">
                      <i class="fas fa-user me-1"></i>
                      {{ $note->user->name ?? 'Unknown' }}
                    </span>
                  </td>
                @endif
                <td>
                  <span class="badge bg-info">{{ $note->created_at->format('M d, Y') }}</span>
                </td>
                <td class="text-end pe-4">
                  <a href="{{ route('notes.edit', $note) }}" class="btn btn-sm btn-warning me-2">
                    <i class="fas fa-edit"></i> Edit
                  </a>
                  <form action="{{ route('notes.destroy', $note) }}" method="POST" style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete this note?')">
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