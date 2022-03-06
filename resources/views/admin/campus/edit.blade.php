@extends('adminlte::page')

@section('title', 'Admin | Edit campus')

@section('content_header')
    <a href="{{ route('admin.campuses.index') }}" class="btn btn-primary">Go Back</a>
   {{-- <h1>Edit campus</h1> --}}
@stop

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col col-6">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Edit campus: {{ $campus->name }}</h3>
                      </div>
                    <form action="{{route('admin.campuses.update', $campus->id)}}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Name:</label>
                                <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" 
                                    id= "name" name="name" value="{{ old('name') ? old('name') : $campus->name }}" placeholder="Enter campus name">
                                @if ($errors->has('name'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary col col-12">Save</button>
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