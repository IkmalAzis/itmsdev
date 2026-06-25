@extends('layouts.skydash_bu')

@section('pagetitle')
  <title>Dashboard — ITMS</title>
@endsection

@section('topbar-title', 'Dashboard')

@section('content')

<div class="page-header">
  <div>
    @foreach($users as $user)
    <h3>Good day, {{ $user->name }}</h3>
    @endforeach
    <p>Here are your submitted system requests.</p>
  </div>
</div>

<div class="card">
  <div class="card-title">{{ Auth::user()->bunit }} — Request List</div>
  <div class="table-wrap">
    <table>
      <thead>
        <tr>
          <th>#</th>
          <th>Request Type</th>
          <th>PIC Name</th>
          <th>Description</th>
          <th>Submitted</th>
        </tr>
      </thead>
      <tbody>
        @php($i = 1)
        @forelse($busunit ?? [] as $bu)
        <tr>
          <td style="color:var(--muted)">{{ $i++ }}</td>
          <td><span class="badge badge-primary">{{ $bu->request }}</span></td>
          <td>{{ $bu->name }}</td>
          <td style="color:var(--muted); max-width:300px">{{ $bu->description }}</td>
          <td style="color:var(--muted); white-space:nowrap">{{ date('d M Y', strtotime($bu->created_at)) }}</td>
        </tr>
        @empty
        <tr>
          <td colspan="5" style="text-align:center; color:var(--muted); padding:2.5rem">
            <i class="fa-solid fa-inbox" style="font-size:1.5rem; margin-bottom:0.5rem; display:block"></i>
            No requests submitted yet.
          </td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>

@endsection
