@extends('layouts.app')

@section('title')
Profile | Change password
@endsection

@section('content')
<div class="container">
    <a href="{{ route('profile.index') }}" class="btn btn-info">Go Back</a>
    <div class="row justify-content-center">
        <div class="col col-6">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Update profile</h3>
                </div>
                <form action="{{route('profile.update_password')}}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="oldpass">Old password:</label>
                            <input type="password" class="form-control {{ $errors->has('old_pass') ? 'is-invalid' : '' }}" 
                                id="oldpass" name="old_pass" value="{{ old('old_pass') }}" placeholder="Enter your old password">
                            @if ($errors->has('old_pass'))
                                <div class="invalid-feedback">
                                    <strong>{{ $errors->first('old_pass') }}</strong>
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="pass">New password:</label>
                            <input type="password" class="form-control {{ $errors->has('pass') ? 'is-invalid' : '' }}" 
                                id="pass" name="pass" value="{{ old('pass') }}" placeholder="Enter your new password">
                            @if ($errors->has('pass'))
                                <div class="invalid-feedback">
                                    <strong>{{ $errors->first('pass') }}</strong>
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="pass_confirmed">New password confimation:</label>
                            <input type="password" class="form-control {{ $errors->has('pass') ? 'is-invalid' : '' }}" 
                                id="pass_confirmed" name="password_confirmed" value="{{ old('password_confirmed') }}" placeholder="Confirm your new password">
                            @if ($errors->has('password_confirmed'))
                                <div class="invalid-feedback">
                                    <strong>{{ $errors->first('password_confirmed') }}</strong>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn col col-12" style="background-color: #17a2b8">Change password</button>
                    </div>
                </form>
            </div> 
        </div>
    </div>
</div>
@endsection