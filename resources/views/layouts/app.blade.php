<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Notes Manager</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
      :root {
        --primary-color: #6c63ff;
        --secondary-color: #ff6b6b;
        --success-color: #51cf66;
        --warning-color: #ffd93d;
        --info-color: #4ecdc4;
        --light-bg: #f8f9fa;
        --border-radius: 12px;
      }

      * { transition: all 0.3s ease; }

      body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        min-height: 100vh;
        padding-bottom: 2rem;
      }

      .navbar {
        background: linear-gradient(135deg, var(--primary-color) 0%, #5a4fb8 100%) !important;
        box-shadow: 0 4px 15px rgba(108, 99, 255, 0.2);
        padding: 1rem 0;
      }

      .navbar-brand {
        font-weight: 700;
        font-size: 1.5rem;
        letter-spacing: -0.5px;
      }

      .navbar-brand i { margin-right: 0.5rem; }

      .nav-link {
        font-weight: 500;
        margin: 0 0.5rem;
        border-radius: 6px;
        transition: all 0.2s;
      }

      .nav-link:hover {
        background: rgba(255, 255, 255, 0.1);
        color: #fff !important;
      }

      .dropdown-menu {
        border-radius: var(--border-radius);
        border: none;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
      }

      .card {
        border: none;
        border-radius: var(--border-radius);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        overflow: hidden;
        transition: transform 0.3s, box-shadow 0.3s;
      }

      .card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
      }

      .btn {
        border-radius: 8px;
        font-weight: 600;
        padding: 0.6rem 1.4rem;
        transition: all 0.2s;
        border: none;
      }

      .btn-primary {
        background: linear-gradient(135deg, var(--primary-color) 0%, #5a4fb8 100%);
      }

      .btn-primary:hover {
        background: linear-gradient(135deg, #5a4fb8 0%, #4a3fa8 100%);
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(108, 99, 255, 0.3);
      }

      .btn-danger {
        background: linear-gradient(135deg, var(--secondary-color) 0%, #ff5252 100%);
      }

      .btn-danger:hover {
        background: linear-gradient(135deg, #ff5252 0%, #ff3838 100%);
      }

      .btn-secondary {
        background: linear-gradient(135deg, #6c757d 0%, #5a6268 100%);
      }

      .btn-secondary:hover {
        background: linear-gradient(135deg, #5a6268 0%, #495057 100%);
      }

      .form-control, .form-select {
        border-radius: 8px;
        border: 2px solid #e9ecef;
        padding: 0.75rem 1rem;
        font-weight: 500;
        transition: all 0.2s;
      }

      .form-control:focus, .form-select:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 0.2rem rgba(108, 99, 255, 0.15);
      }

      .form-label {
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 0.5rem;
      }

      .table {
        border-radius: var(--border-radius);
        overflow: hidden;
      }

      .table thead {
        background: linear-gradient(135deg, var(--primary-color) 0%, #5a4fb8 100%);
        color: white;
      }

      .table tbody tr { transition: all 0.2s; }

      .table tbody tr:hover { background: rgba(108, 99, 255, 0.05); }

      .toast-container .toast {
        border-radius: var(--border-radius);
        border: none;
      }

      .badge {
        border-radius: 20px;
        padding: 0.5rem 0.75rem;
        font-weight: 600;
      }

      h1, h2, h3 { color: #2c3e50; font-weight: 700; }

      .container {
        max-width: 1200px;
        padding-top: 2rem;
      }

      @media (max-width: 768px) {
        .btn { padding: 0.5rem 1rem; font-size: 0.9rem; }
      }

      /* ── Dashboard ── */
      .db-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 1.5rem;
        flex-wrap: wrap;
        gap: 0.5rem;
      }

      .db-title {
        font-size: 1.4rem;
        font-weight: 700;
        color: #2c3e50;
        margin: 0;
      }

      .db-sub {
        font-size: 0.85rem;
        color: #6c757d;
        margin: 2px 0 0;
      }

      .db-date {
        font-size: 0.8rem;
        color: #6c757d;
        background: #fff;
        border: 1px solid #e9ecef;
        border-radius: 8px;
        padding: 6px 12px;
      }

      .stat-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
        gap: 12px;
        margin-bottom: 1.25rem;
      }

      .stat-card-new {
        background: #fff;
        border: 1px solid #e9ecef;
        border-radius: 12px;
        padding: 1rem 1.1rem;
        transition: transform 0.2s, box-shadow 0.2s;
      }

      .stat-card-new:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 20px rgba(0,0,0,0.08);
      }

      .stat-top {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 10px;
      }

      .stat-icon {
        width: 34px;
        height: 34px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 15px;
      }

      .ic-purple { background: #EEEDFE; color: #534AB7; }
      .ic-coral  { background: #FAECE7; color: #993C1D; }
      .ic-teal   { background: #E1F5EE; color: #0F6E56; }
      .ic-amber  { background: #FAEEDA; color: #854F0B; }

      .stat-badge {
        font-size: 10px;
        padding: 2px 7px;
        border-radius: 20px;
      }

      .badge-new { background: #EAF3DE; color: #3B6D11; }

      .stat-num {
        font-size: 26px;
        font-weight: 700;
        color: #2c3e50;
        line-height: 1;
      }

      .stat-label {
        font-size: 12px;
        color: #6c757d;
        margin-top: 3px;
      }

      .bottom-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 12px;
      }

      .db-panel {
        background: #fff;
        border: 1px solid #e9ecef;
        border-radius: 12px;
        padding: 1rem 1.1rem;
      }

      .panel-title {
        font-size: 13px;
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 6px;
      }

      .donut-wrap {
        position: relative;
        width: 110px;
        height: 110px;
        margin: 0 auto 0.75rem;
      }

      .donut-center {
        position: absolute;
        inset: 0;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
      }

      .donut-center span { font-size: 20px; font-weight: 700; color: #2c3e50; }
      .donut-center small { font-size: 11px; color: #6c757d; }

      .donut-legend {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
      }

      .legend-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        display: inline-block;
      }

      .legend-text { font-size: 12px; color: #6c757d; }

      .activity-list { display: flex; flex-direction: column; }

      .activity-item {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 8px 0;
        border-bottom: 1px solid #f1f3f5;
      }

      .activity-item:last-child { border-bottom: none; padding-bottom: 0; }

      .avatar {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        background: #EEEDFE;
        color: #534AB7;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
        font-weight: 600;
        flex-shrink: 0;
      }

      .activity-info { flex: 1; }
      .activity-info p  { font-size: 13px; color: #2c3e50; margin: 0; }
      .activity-info small { font-size: 11px; color: #6c757d; }

      .activity-tag {
        font-size: 11px;
        padding: 2px 8px;
        border-radius: 20px;
        flex-shrink: 0;
      }

      .tag-note { background: #FAECE7; color: #993C1D; }
      .tag-user { background: #EEEDFE; color: #534AB7; }

      /* ── Admin badge sa navbar ── */
      .admin-badge {
        font-size: 10px;
        background: rgba(255,255,255,0.2);
        color: #fff;
        padding: 2px 8px;
        border-radius: 20px;
        margin-left: 6px;
        font-weight: 600;
        letter-spacing: 0.05em;
        vertical-align: middle;
      }
    </style>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
      <div class="container-fluid px-4">
        <a class="navbar-brand" href="{{ url('/') }}">
          <i class="fas fa-sticky-note"></i>Notes Manager
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav" aria-controls="nav" aria-expanded="false">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="nav">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            @auth
              <li class="nav-item">
                <a class="nav-link" href="{{ route('dashboard') }}">
                  <i class="fas fa-chart-line"></i> Dashboard
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ route('notes.index') }}">
                  <i class="fas fa-file-alt"></i> Notes
                </a>
              </li>
              {{-- Admin lang makakakita ng Users link --}}
              @if(auth()->user()->isAdmin())
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('users.index') }}">
                    <i class="fas fa-users"></i> Users
                  </a>
                </li>
              @endif
            @endauth
          </ul>
          <ul class="navbar-nav ms-auto">
            @guest
              <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">
                  <i class="fas fa-sign-in-alt"></i> Login
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ route('register') }}">
                  <i class="fas fa-user-plus"></i> Register
                </a>
              </li>
            @else
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                  <i class="fas fa-user-circle"></i> {{ Auth::user()->name }}
                  {{-- Nagpapakita ng ADMIN badge kung admin --}}
                  @if(auth()->user()->isAdmin())
                    <span class="admin-badge">ADMIN</span>
                  @endif
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                  <li>
                    <a class="dropdown-item" href="{{ route('profile.edit') }}">
                      <i class="fas fa-user-edit"></i> Profile
                    </a>
                  </li>
                  <li><hr class="dropdown-divider"></li>
                  <li>
                    <form method="POST" action="{{ route('logout') }}">
                      @csrf
                      <button class="dropdown-item">
                        <i class="fas fa-sign-out-alt"></i> Logout
                      </button>
                    </form>
                  </li>
                </ul>
              </li>
            @endguest
          </ul>
        </div>
      </div>
    </nav>

    <div class="container">
      @if(session('success'))
        <div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 9999;">
          <div class="toast show align-items-center text-bg-success border-0" role="alert">
            <div class="d-flex">
              <i class="fas fa-check-circle me-2"></i>
              <div class="toast-body">{{ session('success') }}</div>
              <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
          </div>
        </div>
      @endif

      @if($errors->any())
        <div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 9999;">
          <div class="toast show align-items-center text-bg-danger border-0" role="alert">
            <div class="d-flex">
              <i class="fas fa-exclamation-circle me-2"></i>
              <div class="toast-body">{{ $errors->first() }}</div>
              <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
          </div>
        </div>
      @endif

      @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
  </body>
</html>