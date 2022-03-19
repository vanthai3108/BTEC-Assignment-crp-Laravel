@extends('adminlte::page')

@section('title', 'Admin | Edit location')

@section('content_header')
    <a href="{{ route('admin.locations.index') }}" class="btn btn-info">Go Back</a>
   {{-- <h1>Edit location</h1> --}}
@stop

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col col-6">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Edit location: {{ $location->room }}</h3>
            
                      </div>
                    <form action="{{route('admin.locations.update', $location->id)}}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="form-group">
                                <label for="room">Room:</label>
                                <input type="text" class="form-control {{ $errors->has('room') ? 'is-invalid' : '' }}" 
                                    id= "room" name="room" value="{{ old('room') ? old('room') : $location->room }}" placeholder="Enter location room">
                                @if ($errors->has('room'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('room') }}</strong>
                                    </div>
                                @endif
                            </div>
                           
                                <div class="form-group">
                                    <label for="building">Building:</label>
                                    <input type="text" class="form-control {{ $errors->has('building') ? 'is-invalid' : '' }}" 
                                        id= "building" name="building" value="{{ old('building') ? old('building') : $location->building }}" placeholder="Enter location building">
                                    @if ($errors->has('building'))
                                        <div class="invalid-feedback">
                                            <strong>{{ $errors->first('building') }}</strong>
                                        </div>
                                    @endif
                                </div>
                            <div class="form-group">
                                <label for="status">Status:</label>
                                <select class="form-control" id="status" room="status">
                                    <option value="1"
                                        {{ old('status') != null ? (old('status') == 1 ? 'selected' : '') 
                                        : ($location->status == 1 ? 'selected' : '' )}}
                                    >
                                        Active
                                    </option>
                                    <option value="0"
                                        {{ old('status') != null ? (old('status') == 0 ? 'selected' : '') 
                                        : ($location->status == 0 ? 'selected' : '' )}}
                                    >
                                        Disable
                                    </option>
                                </select>
                                @if ($errors->has('status'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('status') }}</strong>
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