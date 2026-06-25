@extends('layouts.skydash')

@section('pagetitle')
  <title>Systems — ITMS</title>
@endsection

@section('topbar-title', 'Systems')

@section('content')

<div class="page-header">
  <div>
    <h3>System Development Info</h3>
    <p>All registered system development entries.</p>
  </div>
  <a href="{{ route('app.itms.system.create') }}" class="btn btn-primary">
    <i class="fa-solid fa-plus"></i> New System
  </a>
</div>

<div class="card">
  <div class="table-wrap">
    <table>
      <thead>
        <tr>
          <th>#</th>
          <th>Project ID</th>
          <th>Methodology</th>
          <th>Platform</th>
          <th>Deployment</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @php($i = 1)
        @forelse($systems as $system)
        <tr>
          <td style="color:var(--muted)">{{ $i++ }}</td>
          <td style="font-weight:600; font-family:monospace; color:var(--accent)">#{{ $system->proid }}</td>
          <td>{{ $system->methodology }}</td>
          <td>
            @if($system->platform == 'web-based')
              <span class="badge badge-info"><i class="fa-solid fa-globe"></i> Web-Based</span>
            @elseif($system->platform == 'mobile')
              <span class="badge badge-success"><i class="fa-solid fa-mobile-screen"></i> Mobile</span>
            @else
              <span class="badge badge-warning"><i class="fa-solid fa-desktop"></i> Stand-Alone</span>
            @endif
          </td>
          <td>
            @if($system->deployment == 'cloud')
              <span class="badge badge-primary"><i class="fa-solid fa-cloud"></i> Cloud</span>
            @else
              <span class="badge badge-warning"><i class="fa-solid fa-server"></i> On-Premises</span>
            @endif
          </td>
          <td>
            <a href="{{ route('app.itms.system.edit', $system->sysid) }}" class="btn btn-warning btn-sm">
              <i class="fa-solid fa-pen"></i> Edit
            </a>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="6" style="text-align:center; color:var(--muted); padding:2.5rem">
            <i class="fa-solid fa-server" style="font-size:1.5rem; margin-bottom:0.5rem; display:block"></i>
            No systems registered yet.
          </td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>

@endsection
