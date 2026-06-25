@extends('layouts.skydash_bu')

@section('pagetitle')
  <title>Profile — ITMS</title>
@endsection

@section('topbar-title', 'Profile')

@section('content')

<div class="page-header">
  <div>
    <h3>Profile</h3>
    <p>Manage your account details.</p>
  </div>
</div>

<div class="card">
  <div class="table-wrap">
    <table>
      <thead>
        <tr>
          <th>#</th>
          <th>Date</th>
          <th>Name</th>
          <th>Phone Number</th>
          <th>Business Unit</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        @php($i = 1)
        @forelse($profiles as $profile)
        <tr>
          <td style="color:var(--muted)">{{ $i++ }}</td>
          <td style="color:var(--muted); white-space:nowrap">{{ date('d-m-Y', strtotime($profile->created_at)) }}</td>
          <td style="font-weight:500">{{ $profile->name }}</td>
          <td style="color:var(--muted)">{{ $profile->phonenum }}</td>
          <td><span class="badge badge-primary">{{ $profile->bunit }}</span></td>
          <td>
            <div style="display:flex; gap:0.4rem; align-items:center">
              <a href="{{ route('app.profile.edit', $profile->userid) }}" class="btn btn-info btn-sm">
                <i class="fa-solid fa-pen"></i> Edit
              </a>
              <form action="{{ route('app.profile.destroy', $profile->userid) }}" method="POST" style="margin:0">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm"
                  onclick="return confirm('Delete this profile?')">
                  <i class="fa-solid fa-trash"></i> Delete
                </button>
              </form>
            </div>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="6" style="text-align:center; color:var(--muted); padding:2.5rem">
            <i class="fa-solid fa-user" style="font-size:1.5rem; margin-bottom:0.5rem; display:block"></i>
            No profile found.
          </td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>

@endsection
