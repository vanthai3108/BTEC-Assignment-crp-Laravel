@extends('layouts.app')

@section('title')
Profile | Edit infomation
@endsection

@section('content')
<div class="container">
    <a href="{{ route('profile.index') }}" class="btn btn-info">Go Back</a>
    <div class="row justify-content-center">
        <div class="col col-6">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Edit infomation</h3>
                </div>
                <form action="{{route('profile.update', $profile->id)}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="form-group">
                            <label for="key">Infomation key:</label>
                            <input type="text" class="form-control {{ $errors->has('key') ? 'is-invalid' : '' }}" 
                                id="key" name="key" value="{{ old('key') ? old('key') : $profile->key }}" placeholder="Enter infomation key">
                                @if ($errors->has('key'))
                                <div class="invalid-feedback">
                                    
                                    <strong>{{ $errors->first('key')}}</strong>
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="value">Infomation value:</label>
                            <input type="text" class="form-control {{ $errors->has('value') ? 'is-invalid' : '' }}" 
                                id="value" name="value" value="{{ old('value') ? old('value') : $profile->value }}" placeholder="Enter infomation value">
                            @if ($errors->has('value'))
                                <div class="invalid-feedback">
                                    <strong>{{ $errors->first('value') }}</strong>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn col col-12" style="background-color: #17a2b8">Save</button>
                    </div>
                </form>
            </div> 
        </div>
    </div>
</div>
@endsection