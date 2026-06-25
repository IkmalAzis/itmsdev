@extends('layouts.skydash_bu')

@section('pagetitle')
    <title>BU Profile Form</title>
@endsection

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="row">
                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                    <h3 class="font-weight-bold">{{ Auth::user()->name }} Profile</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
    <div class="col-12 grid-margin stretch-card"><div class="card">
        <div class="card-body">
            <h4 class="card-title">Profile form</h4>
            @if($profile->userid)<!-- TO CHECK id ALREADY EXIST OR NOT -->
            <form action="{{ route('app.profile.update', $profile->userid) }}" method="post">
                <input type="hidden" name="_method" value="PUT">
            @else
                <form action="{{ route('app.profile.store') }}" method="post">
            @endif
            @csrf
            <form class="forms">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="name" value="{{ old('name', $profile->name) }}">
                    @error('name')
                    <span class="text-danger">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="phonenum">Phone Number</label>
                    <input type="text" class="form-control" name="phonenum" value="{{ old('phonenum', $profile->phonenum) }}">
                    @error('phonenum')
                    <span class="text-danger">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="bunit" class="col-md-4 col-form-label text-md-end">{{ __('Business Unit') }}</label>
                    <select class="form-control" name="bunit"> 
                        <option value="">-- Please Select --</option>
                        <option value="ITMS" {{ old('bunit', $profile->bunit) === 'ITMS' ? 'selected' : '' }}>ITMS</option>
                        <option value="CCI" {{ old('bunit', $profile->bunit) === 'CCI' ? 'selected' : '' }}>CCI</option>
                        <option value="COE" {{ old('bunit', $profile->bunit) === 'COE' ? 'selected' : '' }}>COE</option>
                        <option value="COBA" {{ old('bunit', $profile->bunit) === 'COBA' ? 'selected' : '' }}>COBA</option>
                        <option value="COGS" {{ old('bunit', $profile->bunit) === 'COGS' ? 'selected' : '' }}>COGS</option>
                    </select>
                    @error('bunit')
                    <span class="text-danger">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>
                    
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                        value="{{ old('email', $profile->email) }}">
                    
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>
                    
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password">
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
                </div>
                
                <a href="{{ route('app.profile.index') }}" class="btn btn-info">Cancel</a>
                <button type="submit" class="btn btn-success mr-2">Submit</button>
            </form>
        </div>
    </div>
    </div>
    </div>
</div>
@endsection