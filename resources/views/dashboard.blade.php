@extends('layouts.app')

@section('content')

{{-- Header --}}
<div class="db-header">
  <div>
    <h1 class="db-title"><i class="fas fa-tachometer-alt"></i> Dashboard</h1>
    <p class="db-sub">Welcome back, {{ Auth::user()->name }}!
      @if(Auth::user()->isAdmin())
        Here's your admin overview.
      @else
        Here's your notes overview.
      @endif
    </p>
  </div>
  <div class="db-date">
    <i class="fas fa-calendar-alt"></i> {{ now()->format('F d, Y') }}
  </div>
</div>

{{-- ── ADMIN VIEW ── --}}
@if(Auth::user()->isAdmin())

  <div class="stat-grid">
    <div class="stat-card-new">
      <div class="stat-top">
        <div class="stat-icon ic-purple"><i class="fas fa-users"></i></div>
        <span class="stat-badge badge-new">All</span>
      </div>
      <div class="stat-num">{{ $usersCount }}</div>
      <div class="stat-label">Total users</div>
    </div>

    <div class="stat-card-new">
      <div class="stat-top">
        <div class="stat-icon ic-coral"><i class="fas fa-sticky-note"></i></div>
        <span class="stat-badge badge-new">All</span>
      </div>
      <div class="stat-num">{{ $notesCount }}</div>
      <div class="stat-label">Total notes</div>
    </div>

    <div class="stat-card-new">
      <div class="stat-top">
        <div class="stat-icon ic-teal"><i class="fas fa-user-check"></i></div>
      </div>
      <div class="stat-num">{{ $usersCount }}</div>
      <div class="stat-label">Registered users</div>
    </div>

    <div class="stat-card-new">
      <div class="stat-top">
        <div class="stat-icon ic-amber"><i class="fas fa-chart-line"></i></div>
      </div>
      <div class="stat-num">
        {{ $usersCount > 0 ? round($notesCount / $usersCount, 1) : 0 }}
      </div>
      <div class="stat-label">Notes / user</div>
    </div>
  </div>

  <div class="bottom-grid">
    <div class="db-panel">
      <div class="panel-title"><i class="fas fa-chart-pie"></i> Users distribution</div>
      <div class="donut-wrap">
        <canvas id="usersChart" width="110" height="110"></canvas>
        <div class="donut-center">
          <span>{{ $usersCount }}</span>
          <small>users</small>
        </div>
      </div>
      <div class="donut-legend">
        <span class="legend-dot" style="background:#7F77DD;"></span>
        <span class="legend-text">Total users</span>
      </div>
    </div>

    <div class="db-panel">
      <div class="panel-title"><i class="fas fa-chart-pie"></i> Notes distribution</div>
      <div class="donut-wrap">
        <canvas id="notesChart" width="110" height="110"></canvas>
        <div class="donut-center">
          <span>{{ $notesCount }}</span>
          <small>notes</small>
        </div>
      </div>
      <div class="donut-legend">
        <span class="legend-dot" style="background:#D85A30;"></span>
        <span class="legend-text">Total notes</span>
      </div>
    </div>

    <div class="db-panel">
      <div class="panel-title"><i class="fas fa-bolt"></i> Recent activity</div>
      <div class="activity-list">
        <div class="activity-item">
          <div class="avatar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
          <div class="activity-info">
            <p>{{ Auth::user()->name }} logged in</p>
            <small>Today</small>
          </div>
          <span class="activity-tag tag-user">Auth</span>
        </div>
        <div class="activity-item">
          <div class="avatar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
          <div class="activity-info">
            <p>Managing {{ $usersCount }} users</p>
            <small>Total registered</small>
          </div>
          <span class="activity-tag tag-user">Admin</span>
        </div>
        <div class="activity-item">
          <div class="avatar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
          <div class="activity-info">
            <p>{{ $notesCount }} notes in system</p>
            <small>All users combined</small>
          </div>
          <span class="activity-tag tag-note">Notes</span>
        </div>
      </div>
    </div>
  </div>

{{-- ── REGULAR USER VIEW ── --}}
@else

  <div class="stat-grid">
    <div class="stat-card-new">
      <div class="stat-top">
        <div class="stat-icon ic-coral"><i class="fas fa-sticky-note"></i></div>
        <span class="stat-badge badge-new">Mine</span>
      </div>
      <div class="stat-num">{{ $notesCount }}</div>
      <div class="stat-label">My notes</div>
    </div>

    <div class="stat-card-new">
      <div class="stat-top">
        <div class="stat-icon ic-purple"><i class="fas fa-user"></i></div>
      </div>
      <div class="stat-num">1</div>
      <div class="stat-label">My account</div>
    </div>

    <div class="stat-card-new">
      <div class="stat-top">
        <div class="stat-icon ic-teal"><i class="fas fa-calendar-check"></i></div>
      </div>
      <div class="stat-num">{{ max(1, (int) Auth::user()->created_at->diffInDays(now())) }}</div>
      <div class="stat-label">Days as member</div>
    </div>

    <div class="stat-card-new">
      <div class="stat-top">
        <div class="stat-icon ic-amber"><i class="fas fa-pen"></i></div>
      </div>
      <div class="stat-num">{{ $notesCount > 0 ? $notesCount : '—' }}</div>
      <div class="stat-label">Notes written</div>
    </div>
  </div>

  <div class="bottom-grid">
    <div class="db-panel">
      <div class="panel-title"><i class="fas fa-chart-pie"></i> My notes</div>
      <div class="donut-wrap">
        <canvas id="notesChart" width="110" height="110"></canvas>
        <div class="donut-center">
          <span>{{ $notesCount }}</span>
          <small>notes</small>
        </div>
      </div>
      <div class="donut-legend">
        <span class="legend-dot" style="background:#D85A30;"></span>
        <span class="legend-text">My notes</span>
      </div>
    </div>

    <div class="db-panel">
      <div class="panel-title"><i class="fas fa-bolt"></i> Recent activity</div>
      <div class="activity-list">
        <div class="activity-item">
          <div class="avatar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
          <div class="activity-info">
            <p>{{ Auth::user()->name }} logged in</p>
            <small>Today</small>
          </div>
          <span class="activity-tag tag-user">Auth</span>
        </div>
        <div class="activity-item">
          <div class="avatar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
          <div class="activity-info">
            <p>{{ $notesCount }} note{{ $notesCount == 1 ? '' : 's' }} written</p>
            <small>Total</small>
          </div>
          <span class="activity-tag tag-note">Note</span>
        </div>
        <div class="activity-item">
          <div class="avatar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
          <div class="activity-info">
            <p>Member since {{ Auth::user()->created_at->format('M d, Y') }}</p>
            <small>Account created</small>
          </div>
          <span class="activity-tag tag-user">User</span>
        </div>
      </div>
    </div>

    <div class="db-panel">
      <div class="panel-title"><i class="fas fa-plus-circle"></i> Quick action</div>
      <div style="display:flex; flex-direction:column; gap:10px; margin-top:0.5rem;">
        <a href="{{ route('notes.create') }}" class="btn btn-primary w-100">
          <i class="fas fa-plus"></i> Create new note
        </a>
        <a href="{{ route('notes.index') }}" class="btn btn-secondary w-100">
          <i class="fas fa-list"></i> View all my notes
        </a>
        <a href="{{ route('profile.edit') }}" class="btn btn-secondary w-100">
          <i class="fas fa-user-edit"></i> Edit profile
        </a>
      </div>
    </div>
  </div>

@endif

{{-- Hidden data for charts --}}
<div id="chartData"
  data-users="{{ $usersCount ?? 0 }}"
  data-notes="{{ $notesCount ?? 0 }}"
  style="display:none;">
</div>

@endsection

@push('scripts')
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const chartData = document.getElementById('chartData');
    const usersCount = parseInt(chartData.dataset.users) || 0;
    const notesCount = parseInt(chartData.dataset.notes) || 0;

    function makeDonut(id, count, color) {
      const el = document.getElementById(id);
      if (!el) return;
      const ctx = el.getContext('2d');
      new Chart(ctx, {
        type: 'doughnut',
        data: {
          datasets: [{
            data: [count || 1, 0.0001],
            backgroundColor: [color, 'transparent'],
            borderColor: ['transparent', 'transparent'],
            borderWidth: 0
          }]
        },
        options: {
          responsive: false,
          cutout: '75%',
          plugins: {
            legend: { display: false },
            tooltip: { enabled: false }
          }
        }
      });
    }

    makeDonut('usersChart', usersCount, '#7F77DD');
    makeDonut('notesChart', notesCount, '#D85A30');
  });
</script>
@endpush