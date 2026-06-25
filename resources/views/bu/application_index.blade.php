@extends('layouts.skydash_bu')

@section('pagetitle')
  <title>Application — ITMS</title>
@endsection

@section('topbar-title', 'Application')

@section('content')

<div class="page-header">
  <div>
    <h3>List of Application</h3>
    <p>Manage your system development requests.</p>
  </div>
  <a href="{{ route('app.bu.create') }}" class="btn btn-primary">
    <i class="fa-solid fa-plus"></i> Create New Application
  </a>
</div>

<div class="card">
  <div class="table-wrap">
    <table>
      <thead>
        <tr>
          <th>#</th>
          <th>Date</th>
          <th>PIC Name</th>
          <th>Request Type</th>
          <th>Description</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        @php($i = 1)
        @forelse($bus as $bu)
        <tr>
          <td style="color:var(--muted)">{{ $i++ }}</td>
          <td style="color:var(--muted); white-space:nowrap">{{ date('d-m-Y', strtotime($bu->created_at)) }}</td>
          <td style="font-weight:500">{{ $bu->name }}</td>
          <td><span class="badge badge-primary">{{ $bu->request }}</span></td>
          <td style="color:var(--muted); max-width:300px">{{ $bu->description }}</td>
          <td>
            <div style="display:flex; gap:0.4rem; align-items:center">
              @if($bu->status == 1 || $bu->status == 2)
                <a href="{{ route('app.bu.edit', $bu->bunitid) }}" class="btn btn-info btn-sm disabled">
                  <i class="fa-solid fa-pen"></i> Edit
                </a>
              @else
                <a href="{{ route('app.bu.edit', $bu->bunitid) }}" class="btn btn-info btn-sm">
                  <i class="fa-solid fa-pen"></i> Edit
                </a>
              @endif
              <form action="{{ route('app.bu.destroy', $bu->bunitid) }}" method="POST" style="margin:0">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm"
                  onclick="return confirm('Delete this application?')">
                  <i class="fa-solid fa-trash"></i> Delete
                </button>
              </form>
            </div>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="6" style="text-align:center; color:var(--muted); padding:2.5rem">
            <i class="fa-solid fa-inbox" style="font-size:1.5rem; margin-bottom:0.5rem; display:block"></i>
            No applications yet. Create your first one!
          </td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>

@endsection
