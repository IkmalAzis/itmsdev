@extends('layouts.skydash')

@section('pagetitle')
  <title>Update Progress — ITMS</title>
@endsection

@section('topbar-title', 'Update Progress')

@section('content')

<div class="page-header">
  <div>
    <h3>Update Project Progress</h3>
    <p>Submit your latest progress update for this project.</p>
  </div>
  <a href="{{ route('app.itms.project.index') }}" class="btn btn-info">
    <i class="fa-solid fa-arrow-left"></i> Back
  </a>
</div>

<div style="max-width:640px">
  <div class="card">
    <div class="card-title">Progress Details</div>

    <form action="{{ route('app.itms.project.progressprocess', $project->proid) }}" method="POST">
      @csrf
      <input type="hidden" name="project" value="{{ $project->proid }}">

      <div class="mb-3">
        <label class="form-label">Progress Status <span style="color:var(--danger)">*</span></label>
        <select class="form-select" name="status">
          <option value="0" {{ old('status', $project->status) == '0' ? 'selected' : '' }}>Ahead of Schedule</option>
          <option value="1" {{ old('status', $project->status) == '1' ? 'selected' : '' }}>On Schedule</option>
          <option value="2" {{ old('status', $project->status) == '2' ? 'selected' : '' }}>Delayed</option>
          <option value="3" {{ old('status', $project->status) == '3' ? 'selected' : '' }}>Completed</option>
        </select>
      </div>

      <div class="mb-3">
        <label class="form-label">Progress Date <span style="color:var(--danger)">*</span></label>
        <input type="date" class="form-control @error('progress_date') is-invalid @enderror"
          id="progress_date" name="progress_date"
          value="{{ old('progress_date', $project->progress_date) }}"
          min="{{ now()->format('Y-m-d') }}">
        @error('progress_date')
          <span class="invalid-feedback">{{ $message }}</span>
        @enderror
      </div>

      <div class="mb-3">
        <label class="form-label">Progress Description <span style="color:var(--danger)">*</span></label>
        <textarea class="form-control @error('progress_description') is-invalid @enderror"
          name="progress_description" rows="5"
          placeholder="Describe what has been completed, what's in progress, and any blockers...">{{ old('progress_description', $project->progress_description) }}</textarea>
        @error('progress_description')
          <span class="invalid-feedback">{{ $message }}</span>
        @enderror
      </div>

      <div style="display:flex; gap:0.5rem; justify-content:flex-end; margin-top:0.5rem">
        <a href="{{ route('app.itms.project.index') }}" class="btn btn-info">
          <i class="fa-solid fa-xmark"></i> Cancel
        </a>
        <button type="submit" class="btn btn-primary">
          <i class="fa-solid fa-floppy-disk"></i> Submit Progress
        </button>
      </div>
    </form>
  </div>
</div>

@endsection
