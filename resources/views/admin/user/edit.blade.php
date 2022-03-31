@extends('adminlte::page')

@section('title', 'Admin | Edit user')

@section('content_header')
    <a href="{{ route('admin.users.index') }}" class="btn btn-info">Go Back</a>
   {{-- <h1>Edit campus</h1> --}}
@stop

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col col-6">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Edit user: {{ $user->name }}</h3>
                      </div>
                    <form action="{{route('admin.users.update', $user->id)}}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="text" class="form-control" 
                                    id= "email" name="test" value="{{ $user->email }}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="name">Name:</label>
                                <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" 
                                    id= "name" name="name" value="{{ old('name') ? old('name') : $user->name }}" placeholder="Enter user name">
                                @if ($errors->has('name'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="password">Password:</label>
                                <input type="text" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" 
                                    id= "password" name="password" value="{{ old('password') }}" placeholder="Enter user password">
                                @if ($errors->has('password'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="role">Role:</label>
                                <select class="form-control" id="role" name="role_id">
                                    @foreach ($roles as $role)
                                    <option value="{{ $role->id }}"
                                        {{ old('role_id') != null ? (old('role_id') == $role->id ? 'selected' : '') 
                                        : ($user->role_id == $role->id ? 'selected' : '' )}}
                                    >
                                        {{ $role->name }}
                                    </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('role_id'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('role_id') }}</strong>
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="campus">Campus:</label>
                                <select class="form-control" id="campus" name="campus_id">
                                    @foreach ($campuses as $campus)
                                        <option value="{{ $campus->id }}"
                                            {{ old('campus_id') != null ? (old('campus_id') == $campus->id ? 'selected' : '') 
                                            : ($user->campus_id == $campus->id ? 'selected' : '' )}}
                                        >
                                            {{ $campus->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('campus_id'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('campus_id') }}</strong>
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