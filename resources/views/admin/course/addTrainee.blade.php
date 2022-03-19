@extends('adminlte::page')

@section('title', 'Admin | Add trainee')

@section('content_header')
    <a href="{{ route('admin.courses.show',$course->id) }}" class="btn btn-info">Go Back</a>
    {{-- <h1>Add new campus</h1> --}}
@stop

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col col-6">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Add new trainee</h3>
                    </div>
                    <form action="{{route('admin.courses.add_trainee',$course->id)}}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="user">User:</label>
                                <select class="form-control" id="user" name="user">
                                    @foreach ($trainees as $user)
                                        <option value="{{ $user->id }}"
                                            @if (old('user') == $user->id)
                                                selected
                                            @endif
                                        >
                                            {{ $user->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('user'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('user') }}</strong>
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
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')

@stop