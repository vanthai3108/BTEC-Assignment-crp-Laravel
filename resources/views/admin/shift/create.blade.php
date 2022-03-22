@extends('adminlte::page')

@section('title', 'Admin | Create shift')

@section('content_header')
    <a href="{{ route('admin.shifts.index') }}" class="btn btn-info">Go Back</a>
    {{-- <h1>Add new shift</h1> --}}
@stop

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col col-6">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Add new shift</h3>
                    </div>
                    <form action="{{route('admin.shifts.store')}}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Name:</label>
                                <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" 
                                    id="name" name="name" value="{{ old('name') }}" placeholder="Enter shift name">
                                @if ($errors->has('name'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="start_time">Start time:</label>
                                <input type="time" class="form-control {{ $errors->has('start_time') ? 'is-invalid' : '' }}" 
                                    id="start_time" name="start_time" value="{{ old('start_time') ? old('start_time') : "00:00" }}" >
                                @if ($errors->has('start_time'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('start_time') }}</strong>
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="end_time">End time:</label>
                                <input type="time" class="form-control {{ $errors->has('end_time') ? 'is-invalid' : '' }}" 
                                    id="end_time" name="end_time" value="{{ old('end_time') ? old('end_time') : "00:00" }}" >
                                @if ($errors->has('end_time'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('end_time') }}</strong>
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