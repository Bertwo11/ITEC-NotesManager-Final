@extends('layouts.app')

@section('content')

<style>
  .profile-wrapper {
    max-width: 860px;
    margin: 0 auto;
  }

  .profile-header-card {
    background: linear-gradient(135deg, #6c63ff 0%, #5a4fb8 100%);
    border-radius: 16px;
    padding: 2.5rem 2rem;
    color: #fff;
    display: flex;
    align-items: center;
    gap: 2rem;
    margin-bottom: 1.5rem;
    box-shadow: 0 8px 24px rgba(108,99,255,0.3);
    flex-wrap: wrap;
  }

  .avatar-wrapper {
    position: relative;
    flex-shrink: 0;
  }

  .avatar-img {
    width: 110px;
    height: 110px;
    border-radius: 50%;
    object-fit: cover;
    border: 4px solid rgba(255,255,255,0.5);
    display: block;
  }

  .avatar-placeholder {
    width: 110px;
    height: 110px;
    border-radius: 50%;
    background: rgba(255,255,255,0.2);
    border: 4px solid rgba(255,255,255,0.5);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2.5rem;
    color: #fff;
  }

  .avatar-upload-btn {
    position: absolute;
    bottom: 4px;
    right: 4px;
    width: 30px;
    height: 30px;
    background: #fff;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    box-shadow: 0 2px 8px rgba(0,0,0,0.2);
    transition: transform 0.2s;
  }

  .avatar-upload-btn:hover { transform: scale(1.1); }
  .avatar-upload-btn i { color: #6c63ff; font-size: 0.75rem; }
  .avatar-upload-btn input { display: none; }

  .profile-header-info h2 {
    font-size: 1.5rem;
    font-weight: 700;
    margin-bottom: 0.25rem;
    color: #fff;
  }

  .profile-header-info p {
    font-size: 0.875rem;
    color: rgba(255,255,255,0.75);
    margin: 0;
  }

  .profile-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.4rem;
    background: rgba(255,255,255,0.2);
    color: #fff;
    font-size: 0.72rem;
    padding: 0.25rem 0.75rem;
    border-radius: 2rem;
    margin-top: 0.5rem;
    font-weight: 600;
    letter-spacing: 0.05em;
  }

  .form-card {
    background: #fff;
    border-radius: 16px;
    box-shadow: 0 4px 16px rgba(108,99,255,0.1);
    overflow: hidden;
    margin-bottom: 1.25rem;
  }

  .form-card-header {
    background: #f8f7ff;
    border-bottom: 1px solid rgba(108,99,255,0.1);
    padding: 1rem 1.5rem;
    display: flex;
    align-items: center;
    gap: 0.6rem;
    font-weight: 600;
    font-size: 0.9rem;
    color: #2c3e50;
  }

  .form-card-header i { color: #6c63ff; }

  .form-card-body { padding: 1.5rem; }

  .form-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1.25rem;
  }

  .form-grid.full { grid-template-columns: 1fr; }

  .field-label {
    font-size: 0.8rem;
    font-weight: 600;
    color: #6c757d;
    letter-spacing: 0.04em;
    margin-bottom: 0.4rem;
    display: block;
  }

  .field-input {
    width: 100%;
    padding: 0.7rem 1rem;
    border: 1.5px solid #e9ecef;
    border-radius: 10px;
    font-size: 0.9rem;
    font-family: inherit;
    color: #2c3e50;
    transition: all 0.2s;
    background: #fdfdfd;
  }

  .field-input:focus {
    outline: none;
    border-color: #6c63ff;
    box-shadow: 0 0 0 3px rgba(108,99,255,0.1);
    background: #fff;
  }

  select.field-input { cursor: pointer; }

  .info-pill {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    background: #f8f7ff;
    border: 1px solid rgba(108,99,255,0.15);
    border-radius: 2rem;
    padding: 0.4rem 1rem;
    font-size: 0.8rem;
    color: #6c63ff;
    font-weight: 500;
    margin-bottom: 0.5rem;
  }

  .btn-save {
    background: linear-gradient(135deg, #6c63ff 0%, #5a4fb8 100%);
    color: #fff;
    border: none;
    border-radius: 10px;
    padding: 0.75rem 2rem;
    font-size: 0.9rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s;
    box-shadow: 0 4px 12px rgba(108,99,255,0.3);
    font-family: inherit;
  }

  .btn-save:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 18px rgba(108,99,255,0.4);
  }

  .btn-back {
    background: #f0f0f0;
    color: #6c757d;
    border: none;
    border-radius: 10px;
    padding: 0.75rem 1.5rem;
    font-size: 0.9rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s;
    text-decoration: none;
    font-family: inherit;
    display: inline-block;
  }

  .btn-back:hover {
    background: #e2e2e2;
    color: #495057;
  }

  .action-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 1rem;
  }

  .member-since {
    font-size: 0.78rem;
    color: #adb5bd;
  }

  @media (max-width: 600px) {
    .form-grid { grid-template-columns: 1fr; }
    .profile-header-card { flex-direction: column; text-align: center; }
  }
</style>

<div class="profile-wrapper">

  {{-- ── PROFILE HEADER ── --}}
  <div class="profile-header-card">
    <div class="avatar-wrapper">
      @if($user->profile_picture)
        <img src="{{ asset('storage/' . $user->profile_picture) }}"
             alt="Profile" class="avatar-img" id="avatarPreview">
      @else
        <div class="avatar-placeholder" id="avatarPlaceholder">
          <i class="fas fa-user"></i>
        </div>
        <img src="" alt="Preview" class="avatar-img" id="avatarPreview" style="display:none;">
      @endif

      <label class="avatar-upload-btn" title="Change photo">
        <i class="fas fa-camera"></i>
        <input type="file" id="avatarInput" accept="image/*">
      </label>
    </div>

    <div class="profile-header-info">
      <h2>{{ $user->name }}</h2>
      <p>{{ $user->email }}</p>
      <div class="profile-badge">
        <i class="fas fa-{{ $user->isAdmin() ? 'crown' : 'user' }}"></i>
        {{ $user->isAdmin() ? 'Administrator' : 'Member' }}
      </div>
    </div>
  </div>

  {{-- ── FORM ── --}}
  <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" id="profileForm">
    @csrf

    {{-- Hidden file input carried from avatar button --}}
    <input type="file" name="profile_picture" id="profilePictureInput" accept="image/*" style="display:none;">

    {{-- Basic Info --}}
    <div class="form-card">
      <div class="form-card-header">
        <i class="fas fa-id-card"></i> Basic Information
      </div>
      <div class="form-card-body">
        <div class="form-grid">
          <div>
            <label class="field-label">FULL NAME</label>
            <input name="name" type="text" class="field-input"
                   value="{{ old('name', $user->name) }}"
                   placeholder="Your full name" required>
          </div>
          <div>
            <label class="field-label">EMAIL ADDRESS</label>
            <input name="email" type="email" class="field-input"
                   value="{{ old('email', $user->email) }}"
                   placeholder="your@email.com" required>
          </div>
          <div>
            <label class="field-label">PHONE NUMBER</label>
            <input name="phone" type="text" class="field-input"
                   value="{{ old('phone', $user->phone) }}"
                   placeholder="+63 9XX XXX XXXX">
          </div>
          <div>
            <label class="field-label">GENDER</label>
            <select name="gender" class="field-input">
              <option value="">Select gender</option>
              <option value="male"   {{ old('gender', $user->gender) == 'male'   ? 'selected' : '' }}>Male</option>
              <option value="female" {{ old('gender', $user->gender) == 'female' ? 'selected' : '' }}>Female</option>
              <option value="other"  {{ old('gender', $user->gender) == 'other'  ? 'selected' : '' }}>Other</option>
            </select>
          </div>
          <div>
            <label class="field-label">BIRTHDATE</label>
            <input name="birthdate" type="date" class="field-input"
                   value="{{ old('birthdate', $user->birthdate ? \Carbon\Carbon::parse($user->birthdate)->format('Y-m-d') : '') }}">
          </div>
        </div>
      </div>
    </div>

    {{-- Address --}}
    <div class="form-card">
      <div class="form-card-header">
        <i class="fas fa-map-marker-alt"></i> Address
      </div>
      <div class="form-card-body">
        <div class="form-grid full">
          <div>
            <label class="field-label">FULL ADDRESS</label>
            <textarea name="address" class="field-input" rows="3"
                      placeholder="Street, City, Province, ZIP">{{ old('address', $user->address) }}</textarea>
          </div>
        </div>
      </div>
    </div>

    {{-- Account Info (read-only) --}}
    <div class="form-card">
      <div class="form-card-header">
        <i class="fas fa-info-circle"></i> Account Details
      </div>
      <div class="form-card-body">
        <div style="display:flex; flex-wrap:wrap; gap:0.75rem;">
          <div class="info-pill">
            <i class="fas fa-calendar-plus"></i>
            Member since {{ $user->created_at->format('F d, Y') }}
          </div>
          <div class="info-pill">
            <i class="fas fa-{{ $user->isAdmin() ? 'crown' : 'user-check' }}"></i>
            Role: {{ ucfirst($user->role) }}
          </div>
          <div class="info-pill">
            <i class="fas fa-sticky-note"></i>
            {{ \App\Models\Note::where('user_id', $user->id)->count() }} notes written
          </div>
        </div>
      </div>
    </div>

    {{-- Actions --}}
    <div class="action-row">
      <a href="{{ route('dashboard') }}" class="btn-back">
        <i class="fas fa-arrow-left me-2"></i>Back to Dashboard
      </a>
      <button type="submit" class="btn-save">
        <i class="fas fa-save me-2"></i>Save Changes
      </button>
    </div>

  </form>
</div>

@endsection

@push('scripts')
<script>
  // Avatar preview + sync to hidden input
  document.getElementById('avatarInput').addEventListener('change', function () {
    const file = this.files[0];
    if (!file) return;

    // Sync to the actual form input
    const dt = new DataTransfer();
    dt.items.add(file);
    document.getElementById('profilePictureInput').files = dt.files;

    // Show preview
    const reader = new FileReader();
    reader.onload = function (e) {
      const preview = document.getElementById('avatarPreview');
      const placeholder = document.getElementById('avatarPlaceholder');
      preview.src = e.target.result;
      preview.style.display = 'block';
      if (placeholder) placeholder.style.display = 'none';
    };
    reader.readAsDataURL(file);
  });
</script>
@endpush