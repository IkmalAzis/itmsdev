@extends('layouts.skydash')

@section('pagetitle')
    <title>ITMS Developer</title>
@endsection

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="row">
                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                    <h3 class="font-weight-bold">List of All Developers</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-borderless">
                            <thead>
                                <tr>
                                    <th>No</th><th>Developer Name</th><th>Phone Number</th><th>Email</th><th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php($i = 1)
                                @foreach($users as $user)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->phonenum }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @if($user->status == 1)
                                            <div class="badge bg-success text-white">Available</div>
                                        @else
                                            <div class="badge bg-danger text-white">Unavailable</div>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection