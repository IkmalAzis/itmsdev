@extends('layouts.skydash')

@section('pagetitle')
  <title>Project Details — ITMS</title>
@endsection

@section('topbar-title', 'Project Details')

@section('content')

<div class="page-header">
  <div>
    <h3>Project & System Details</h3>
    <p>Full breakdown of this project assignment.</p>
  </div>
  <a href="{{ route('app.itms.project.index') }}" class="btn btn-info">
    <i class="fa-solid fa-arrow-left"></i> Back
  </a>
</div>

<div style="display:grid; grid-template-columns:1fr 1fr; gap:1rem; margin-bottom:1rem;">

  <!-- Project Info -->
  <div class="card">
    <div class="card-title">Project Info</div>
    <table style="width:100%">
      <tbody>
        <tr>
          <td style="color:var(--muted); width:40%; padding:0.5rem 0; font-size:0.82rem">Business Unit</td>
          <td style="padding:0.5rem 0; font-weight:600">{{ $project->businessUnit->user->bunit }}</td>
        </tr>
        <tr>
          <td style="color:var(--muted); padding:0.5rem 0; font-size:0.82rem; border-top:1px solid var(--border)">PIC Name</td>
          <td style="padding:0.5rem 0; border-top:1px solid var(--border)">{{ $project->businessUnit->name }}</td>
        </tr>
        <tr>
          <td style="color:var(--muted); padding:0.5rem 0; font-size:0.82rem; border-top:1px solid var(--border)">Start Date</td>
          <td style="padding:0.5rem 0; border-top:1px solid var(--border)">{{ date('d M Y', strtotime($project->start_date)) }}</td>
        </tr>
        <tr>
          <td style="color:var(--muted); padding:0.5rem 0; font-size:0.82rem; border-top:1px solid var(--border)">End Date</td>
          <td style="padding:0.5rem 0; border-top:1px solid var(--border)">{{ date('d M Y', strtotime($project->end_date)) }}</td>
        </tr>
        <tr>
          <td style="color:var(--muted); padding:0.5rem 0; font-size:0.82rem; border-top:1px solid var(--border)">Duration</td>
          <td style="padding:0.5rem 0; border-top:1px solid var(--border)">{{ $project->duration }}</td>
        </tr>
        <tr>
          <td style="color:var(--muted); padding:0.5rem 0; font-size:0.82rem; border-top:1px solid var(--border)">Status</td>
          <td style="padding:0.5rem 0; border-top:1px solid var(--border)">
            @if($project->status == 0)
              <span class="badge badge-info"><i class="fa-solid fa-circle-up"></i> Ahead of Schedule</span>
            @elseif($project->status == 1)
              <span class="badge badge-primary"><i class="fa-solid fa-circle-check"></i> On Schedule</span>
            @elseif($project->status == 3)
              <span class="badge badge-success"><i class="fa-solid fa-flag-checkered"></i> Completed</span>
            @else
              <span class="badge badge-danger"><i class="fa-solid fa-clock"></i> Delayed</span>
            @endif
          </td>
        </tr>
      </tbody>
    </table>
  </div>

  <!-- Progress Info -->
  <div class="card">
    <div class="card-title">Progress Update</div>
    <table style="width:100%">
      <tbody>
        <tr>
          <td style="color:var(--muted); width:40%; padding:0.5rem 0; font-size:0.82rem">Progress Date</td>
          <td style="padding:0.5rem 0">{{ date('d M Y', strtotime($project->progress_date)) }}</td>
        </tr>
        <tr>
          <td style="color:var(--muted); padding:0.5rem 0; font-size:0.82rem; border-top:1px solid var(--border)">Description</td>
          <td style="padding:0.5rem 0; border-top:1px solid var(--border); color:var(--muted)">
            {{ $project->progress_description ?? '—' }}
          </td>
        </tr>
        <tr>
          <td style="color:var(--muted); padding:0.5rem 0; font-size:0.82rem; border-top:1px solid var(--border)">Lead Developer</td>
          <td style="padding:0.5rem 0; border-top:1px solid var(--border); font-weight:600">{{ $project->user->name ?? '—' }}</td>
        </tr>
      </tbody>
    </table>
  </div>
</div>

<!-- Developers -->
<div class="card">
  <div class="card-title">Assigned Developers</div>

  @if($project->developers && $project->developers->count())
  <div class="table-wrap" style="margin-bottom:1.25rem">
    <table>
      <thead>
        <tr>
          <th>#</th>
          <th>Name</th>
          <th>Email</th>
          <th>Phone</th>
        </tr>
      </thead>
      <tbody>
        @php($i = 1)
        @foreach($project->developers as $dev)
        <tr>
          <td style="color:var(--muted)">{{ $i++ }}</td>
          <td style="font-weight:500">{{ $dev->name }}</td>
          <td style="color:var(--muted)">{{ $dev->email }}</td>
          <td style="color:var(--muted)">{{ $dev->phonenum }}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  @else
  <p style="color:var(--muted); font-size:0.85rem; margin-bottom:1rem">No developers assigned yet.</p>
  @endif

  <div style="display:grid; grid-template-columns:1fr auto; gap:0.75rem; align-items:end">
    <form method="POST" action="{{ route('app.itms.project.attachDevelopers', $project) }}" style="display:flex; gap:0.5rem; align-items:center; flex-wrap:wrap">
      @csrf
      <select name="developer_ids[]" class="form-select" multiple
        style="min-width:220px; min-height:80px;">
        @foreach($availableDevelopers as $developer)
          <option value="{{ $developer->userid }}">{{ $developer->name }}</option>
        @endforeach
      </select>
      <button type="submit" class="btn btn-success" style="align-self:flex-end">
        <i class="fa-solid fa-user-plus"></i> Attach
      </button>
    </form>

    <form method="POST" action="{{ route('app.itms.project.detachDevelopers', $project) }}">
      @csrf
      <button type="submit" class="btn btn-danger"
        onclick="return confirm('Remove all developers from this project?')">
        <i class="fa-solid fa-user-minus"></i> Detach All
      </button>
    </form>
  </div>
</div>

@endsection
