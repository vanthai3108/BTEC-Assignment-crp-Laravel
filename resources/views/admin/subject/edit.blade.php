@extends('adminlte::page')

@section('title', 'Admin | Edit subject')

@section('content_header')
    <a href="{{ route('admin.subjects.index') }}" class="btn btn-info">Go Back</a>
   {{-- <h1>Edit subject</h1> --}}
@stop

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col col-6">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Edit subject: {{ $subject->code }}</h3>
                      </div>
                    <form action="{{route('admin.subjects.update', $subject->id)}}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="form-group">
                                <label for="code">Code:</label>
                                <input type="text" class="form-control {{ $errors->has('code') ? 'is-invalid' : '' }}" 
                                    id= "code" name="code" value="{{ old('code') ? old('code') : $subject->code }}" placeholder="Enter subject code">
                                @if ($errors->has('code'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('code') }}</strong>
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="name">Name:</label>
                                <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" 
                                    id= "name" name="name" value="{{ old('name') ? old('name') : $subject->name }}" placeholder="Enter subject name">
                                @if ($errors->has('name'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="sessions">Sessions:</label>
                                <input type="number" class="form-control {{ $errors->has('sessions') ? 'is-invalid' : '' }}" 
                                    id= "sessions" name="sessions" value="{{ old('sessions') ? old('sessions') : $subject->sessions }}" placeholder="Enter subject sessions">
                                @if ($errors->has('sessions'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('sessions') }}</strong>
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="category">Category:</label>
                                <select class="form-control" id="category" name="category_id">
                                    @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ old('category_id') != null ? (old('category_id') == $category->id ? 'selected' : '') 
                                        : ($subject->category_id == $category->id ? 'selected' : '' )}}
                                    >
                                        {{ $category->name }}
                                    </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('category_id'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('role_id') }}</strong>
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="status">Status:</label>
                                <select class="form-control" id="status" name="status">
                                    <option value="1"
                                        {{ old('status') != null ? (old('status') == 1 ? 'selected' : '') 
                                        : ($subject->status == 1 ? 'selected' : '' )}}
                                    >
                                        Active
                                    </option>
                                    <option value="0"
                                        {{ old('status') != null ? (old('status') == 0 ? 'selected' : '') 
                                        : ($subject->status == 0 ? 'selected' : '' )}}
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