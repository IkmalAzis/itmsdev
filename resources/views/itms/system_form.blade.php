@extends('layouts.skydash')

@section('pagetitle')
  <title>{{ $system->sysid ? 'Edit' : 'New' }} System — ITMS</title>
@endsection

@section('topbar-title')
  {{ $system->sysid ? 'Edit System' : 'New System' }}
@endsection

@section('content')

<div class="page-header">
  <div>
    <h3>{{ $system->sysid ? 'Edit System Information' : 'Register System Development' }}</h3>
    <p>Link a system to an existing project with its technical details.</p>
  </div>
  <a href="{{ route('app.itms.system.index') }}" class="btn btn-info">
    <i class="fa-solid fa-arrow-left"></i> Back
  </a>
</div>

<div style="max-width:600px">
  <div class="card">
    <div class="card-title">System Details</div>

    @if($system->sysid)
      <form action="{{ route('app.itms.system.update', $system->sysid) }}" method="POST">
        @method('PUT')
    @else
      <form action="{{ route('app.itms.system.store') }}" method="POST">
    @endif
    @csrf

    <div class="mb-3">
      <label class="form-label">Project <span style="color:var(--danger)">*</span></label>
      <select class="form-select" name="proid">
        @foreach($project as $pro)
          @foreach($bunit as $b)
            @if($b->status == 1)
              <option value="{{ $pro->proid }}" {{ old('proid') == $pro->proid ? 'selected' : '' }}>
                {{ $b->name }} — {{ $b->user->bunit }} — {{ $b->request }}
              </option>
            @endif
          @endforeach
        @endforeach
      </select>
      @error('bunitid')
        <span class="invalid-feedback">{{ $message }}</span>
      @enderror
    </div>

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
        <option value="web-based"          {{ old('platform', $system->platform) == 'web-based'          ? 'selected' : '' }}>Web-Based</option>
        <option value="mobile"             {{ old('platform', $system->platform) == 'mobile'             ? 'selected' : '' }}>Mobile</option>
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

    <div style="display:flex; gap:0.5rem; justify-content:flex-end; margin-top:0.5rem">
      <a href="{{ route('app.itms.system.index') }}" class="btn btn-info">
        <i class="fa-solid fa-xmark"></i> Cancel
      </a>
      <button type="submit" class="btn btn-primary">
        <i class="fa-solid fa-floppy-disk"></i> {{ $system->sysid ? 'Update' : 'Save System' }}
      </button>
    </div>

    </form>
  </div>
</div>

@endsection
