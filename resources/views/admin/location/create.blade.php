@extends('adminlte::page')

@section('title', 'Admin | Create location')

@section('content_header')
    <a href="{{ route('admin.locations.index') }}" class="btn btn-info">Go Back</a>
    {{-- <h1>Add new location</h1> --}}
@stop

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col col-6">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Add new location</h3>
                    </div>
                    <form action="{{route('admin.locations.store')}}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="room">Room:</label>
                                <input type="text" class="form-control {{ $errors->has('room') ? 'is-invalid' : '' }}" 
                                    id="name" name="room" value="{{ old('room') }}" placeholder="Enter location room">
                                @if ($errors->has('room'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('room') }}</strong>
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="building">Building:</label>
                                <input type="text" class="form-control {{ $errors->has('building') ? 'is-invalid' : '' }}" 
                                    id="name" name="building" value="{{ old('building') }}" placeholder="Enter location building">
                                @if ($errors->has('building'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('building') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-info col col-12">Save</button>
                        </div>
                    </form>
                </div>                
            </div>
        </div>        
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')

@stop