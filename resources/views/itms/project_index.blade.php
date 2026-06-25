@extends('layouts.skydash')

@section('pagetitle')
  @if(Auth::user()->usertype == 0)
    <title>Project & System — ITMS</title>
  @else
    <title>My Progress — ITMS</title>
  @endif
@endsection

@section('topbar-title')
  @if(Auth::user()->usertype == 0) Project & System
  @else My Progress
  @endif
@endsection

@section('content')

<div class="page-header">
  <div>
    <h3>
      @if(Auth::user()->usertype == 0) All Projects & Systems
      @else My Assigned Projects
      @endif
    </h3>
    <p>Overview of all IT projects across business units.</p>
  </div>
  @can('isManager')
  <a href="{{ route('app.itms.project.create') }}" class="btn btn-primary">
    <i class="fa-solid fa-plus"></i> Assign Project
  </a>
  @endcan
</div>

<div class="card">
  <div class="table-wrap">
    <table>
      <thead>
        <tr>
          <th>#</th>
          <th>Business Unit</th>
          <th>PIC Name</th>
          <th>Start Date</th>
          <th>End Date</th>
          <th>Methodology</th>
          <th>Platform</th>
          <th>Deployment</th>
          <th>Status</th>
          <th>Last Update</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @php($i = 1)
        @forelse($systems as $sys)
        <tr>
          <td style="color:var(--muted)">{{ $i++ }}</td>
          <td style="font-weight:600">{{ $sys->project->businessUnit->user->bunit }}</td>
          <td>{{ $sys->project->businessUnit->name }}</td>
          <td style="white-space:nowrap; color:var(--muted)">{{ date('d M Y', strtotime($sys->project->start_date)) }}</td>
          <td style="white-space:nowrap; color:var(--muted)">{{ date('d M Y', strtotime($sys->project->end_date)) }}</td>
          <td>{{ $sys->methodology }}</td>
          <td>{{ $sys->platform }}</td>
          <td>{{ $sys->deployment }}</td>
          <td>
            @if($sys->project->status == 0)
              <span class="badge badge-info"><i class="fa-solid fa-circle-up"></i> Ahead</span>
            @elseif($sys->project->status == 1)
              <span class="badge badge-primary"><i class="fa-solid fa-circle-check"></i> On Schedule</span>
            @elseif($sys->project->status == 3)
              <span class="badge badge-success"><i class="fa-solid fa-flag-checkered"></i> Completed</span>
            @else
              <span class="badge badge-danger"><i class="fa-solid fa-clock"></i> Delayed</span>
            @endif
          </td>
          <td style="white-space:nowrap; color:var(--muted)">{{ date('d M Y', strtotime($sys->project->progress_date)) }}</td>
          <td style="white-space:nowrap">
            @can('isManager')
            <a href="{{ route('app.itms.project.show', $sys->proid) }}" class="btn btn-info btn-sm">
              <i class="fa-solid fa-eye"></i> Details
            </a>
            @endcan
            @can('isADev')
              @if($sys->project->status == 3)
                <span class="btn btn-warning btn-sm disabled">
                  <i class="fa-solid fa-pen"></i> Update
                </span>
              @else
                <a href="{{ route('app.itms.project.progress', $sys->proid) }}" class="btn btn-warning btn-sm">
                  <i class="fa-solid fa-pen"></i> Update
                </a>
              @endif
            @endcan
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="11" style="text-align:center; color:var(--muted); padding:2.5rem">
            <i class="fa-solid fa-folder-open" style="font-size:1.5rem; margin-bottom:0.5rem; display:block"></i>
            No projects found.
          </td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>

@endsection
