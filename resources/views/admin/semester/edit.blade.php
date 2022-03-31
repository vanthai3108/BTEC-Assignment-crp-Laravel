@extends('adminlte::page')

@section('title', 'Admin | Edit semester')

@section('content_header')
    <a href="{{ route('admin.semesters.index') }}" class="btn btn-info">Go Back</a>
   {{-- <h1>Edit semester</h1> --}}
@stop

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col col-6">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Edit semester: {{ $semester->name }}</h3>
                      </div>
                    <form action="{{route('admin.semesters.update', $semester->id)}}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Name:</label>
                                <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" 
                                    id= "name" name="name" value="{{ old('name') ? old('name') : $semester->name }}" placeholder="Enter semester name">
                                @if ($errors->has('name'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="status">Status:</label>
                                <select class="form-control" id="status" name="status">
                                    <option value="1"
                                        {{ old('status') != null ? (old('status') == 1 ? 'selected' : '') 
                                        : ($semester->status == 1 ? 'selected' : '' )}}
                                    >
                                        Active
                                    </option>
                                    <option value="0"
                                        {{ old('status') != null ? (old('status') == 0 ? 'selected' : '') 
                                        : ($semester->status == 0 ? 'selected' : '' )}}
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

@stop

@section('js')
    
@stop