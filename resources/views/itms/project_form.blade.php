@extends('layouts.skydash')

@section('pagetitle')
  <title>{{ $project->id ? 'Edit' : 'Assign' }} Project — ITMS</title>
@endsection

@section('topbar-title')
  {{ $project->id ? 'Edit Project' : 'Assign Project' }}
@endsection

@section('content')

<div class="page-header">
  <div>
    <h3>{{ $project->id ? 'Edit Project Assignment' : 'Assign New Project' }}</h3>
    <p>Fill in project details and system information below.</p>
  </div>
  <a href="{{ route('app.itms.project.index') }}" class="btn btn-info">
    <i class="fa-solid fa-arrow-left"></i> Back
  </a>
</div>

@if($project->id)
  <form action="{{ route('app.itms.project.update', $project->id) }}" method="POST">
    @method('PUT')
    <input type="hidden" name="sysid" value="{{ $project->system->sysid ?? old('sysid') }}">
@else
  <form action="{{ route('app.itms.project.store') }}" method="POST">
@endif
@csrf

<div style="display:grid; grid-template-columns:1fr 1fr; gap:1rem;">

  <!-- Left: Project Info -->
  <div class="card">
    <div class="card-title">Project Information</div>

    <div class="mb-3">
      <label class="form-label">Business Unit Owner <span style="color:var(--danger)">*</span></label>
      <select class="form-select" name="userid">
        @foreach($users as $user)
          @if($user->usertype == 1)
            <option value="{{ $user->userid }}" {{ old('userid') == $user->userid ? 'selected' : '' }}>
              {{ $user->bunit }}
            </option>
          @endif
        @endforeach
      </select>
      @error('userid')
        <span class="invalid-feedback">{{ $message }}</span>
      @enderror
    </div>

    <div class="mb-3">
      <label class="form-label">Person in Charge <span style="color:var(--danger)">*</span></label>
      <select class="form-select" name="bunitid">
        @foreach($bu as $b)
          @if($b->status == 1)
            <option value="{{ $b->bunitid }}" {{ old('bunitid') == $b->bunitid ? 'selected' : '' }}>
              {{ $b->name }} — {{ $b->user->bunit }} — {{ $b->request }}
            </option>
          @endif
        @endforeach
      </select>
      @error('bunitid')
        <span class="invalid-feedback">{{ $message }}</span>
      @enderror
    </div>

    <div style="display:grid; grid-template-columns:1fr 1fr; gap:0.75rem">
      <div class="mb-3">
        <label class="form-label">Start Date <span style="color:var(--danger)">*</span></label>
        <input type="date" class="form-control" id="start_date" name="start_date"
          onchange="calcDuration()"
          value="{{ old('start_date', $project->start_date) }}"
          min="{{ now()->format('Y-m-d') }}">
        @error('start_date')
          <span class="invalid-feedback">{{ $message }}</span>
        @enderror
      </div>
      <div class="mb-3">
        <label class="form-label">End Date <span style="color:var(--danger)">*</span></label>
        <input type="date" class="form-control" id="end_date" name="end_date"
          onchange="calcDuration()"
          value="{{ old('end_date', $project->end_date) }}"
          min="{{ now()->format('Y-m-d') }}">
        @error('end_date')
          <span class="invalid-feedback">{{ $message }}</span>
        @enderror
      </div>
    </div>

    <div class="mb-3">
      <label class="form-label">Duration (days)</label>
      <input type="text" class="form-control" id="duration" name="duration"
        placeholder="Auto-calculated" readonly
        value="{{ old('duration', $project->duration) }}"
        style="color:var(--muted)">
    </div>

    <div class="mb-3">
      <label class="form-label">Project Status <span style="color:var(--danger)">*</span></label>
      <select class="form-select" name="status">
        <option value="0" {{ old('status', $project->status) == '0' ? 'selected' : '' }}>Ahead of Schedule</option>
        <option value="1" {{ old('status', $project->status) == '1' ? 'selected' : '' }}>On Schedule</option>
        <option value="2" {{ old('status', $project->status) == '2' ? 'selected' : '' }}>Delayed</option>
        <option value="3" {{ old('status', $project->status) == '3' ? 'selected' : '' }}>Completed</option>
      </select>
    </div>

    <div class="mb-3">
      <label class="form-label">Lead Developer <span style="color:var(--danger)">*</span></label>
      <select class="form-select" name="userid">
        @foreach($devs as $dev)
          @if($dev->usertype == 2 && $dev->status == 1)
            <option value="{{ $dev->userid }}" {{ old('userid') == $dev->userid ? 'selected' : '' }}>
              {{ $dev->name }}
            </option>
          @endif
        @endforeach
      </select>
      @error('userid')
        <span class="invalid-feedback">{{ $message }}</span>
      @enderror
    </div>
  </div>

  <!-- Right: System Info -->
  <div class="card">
    <div class="card-title">System Information</div>

    <div class="mb-3">
      <label class="form-label">Development Methodology <span style="color:var(--danger)">*</span></label>
      <select class="form-select" name="methodology">
        @php
          $methodologies = [
            'Agile Development', 'Waterfall Development', 'Extreme Programming',
            'Lean Development', 'Prototyping Methodology', 'Dynamic Systems Development',
            'Feature Driven Development', 'Rational Unified Process',
            'Spiral Development Model', 'Joint Application Development',
            'Scrum Development', 'Rapid Application Development'
          ];
        @endphp
        @foreach($methodologies as $m)
          <option value="{{ $m }}" {{ old('methodology', $system->methodology) == $m ? 'selected' : '' }}>
            {{ $m }}
          </option>
        @endforeach
      </select>
    </div>

    <div class="mb-3">
      <label class="form-label">System Platform <span style="color:var(--danger)">*</span></label>
      <select class="form-select" name="platform">
        <option value="web-based"        {{ old('platform', $system->platform) == 'web-based'        ? 'selected' : '' }}>Web-Based</option>
        <option value="mobile"           {{ old('platform', $system->platform) == 'mobile'           ? 'selected' : '' }}>Mobile</option>
        <option value="stand-alone system" {{ old('platform', $system->platform) == 'stand-alone system' ? 'selected' : '' }}>Stand-Alone System</option>
      </select>
    </div>

    <div class="mb-3">
      <label class="form-label">Deployment Type <span style="color:var(--danger)">*</span></label>
      <select class="form-select" name="deployment">
        <option value="cloud"       {{ old('deployment', $system->deployment) == 'cloud'       ? 'selected' : '' }}>Cloud</option>
        <option value="on-premises" {{ old('deployment', $system->deployment) == 'on-premises' ? 'selected' : '' }}>On-Premises</option>
      </select>
    </div>

    <div style="display:flex; gap:0.5rem; margin-top:1.5rem; justify-content:flex-end">
      <a href="{{ route('app.itms.project.index') }}" class="btn btn-info">
        <i class="fa-solid fa-xmark"></i> Cancel
      </a>
      <button type="submit" class="btn btn-primary">
        <i class="fa-solid fa-floppy-disk"></i> {{ $project->id ? 'Update' : 'Assign Project' }}
      </button>
    </div>
  </div>

</div>
</form>

<script>
function calcDuration() {
  var start = document.getElementById('start_date').value;
  var end   = document.getElementById('end_date').value;
  if (start && end) {
    var days = (new Date(end) - new Date(start)) / (1000 * 60 * 60 * 24);
    document.getElementById('duration').value = days > 0 ? days + ' days' : '—';
  }
}
</script>

@endsection
