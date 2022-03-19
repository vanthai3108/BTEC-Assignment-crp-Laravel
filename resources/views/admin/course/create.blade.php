@extends('adminlte::page')

@section('title', 'Admin | Create course')

@section('content_header')
    <a href="{{ route('admin.classes.index') }}" class="btn btn-info">Go Back</a>
    {{-- <h1>Add new campus</h1> --}}
@stop

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col col-6">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Add new course</h3>
                    </div>
                    <form action="{{route('admin.courses.store')}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="subject">Subject:</label>
                            <select class="form-control" id="role" name="subject_id">
                                @foreach ($subjects as $subject)
                                    <option value="{{ $subject->id }}"
                                        @if (old('subject_id') == $subject->id)
                                            selected
                                        @endif
                                    >
                                        {{ $subject->name }}
                                    </option>
                                @endforeach
                            </select>
                            @if ($errors->has('subject_id'))
                                <div class="invalid-feedback">
                                    <strong>{{ $errors->first('subject_id') }}</strong>
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="class">Class:</label>
                            <select class="form-control" id="class" name="class_id">
                                @foreach ($classes as $class)
                                    <option value="{{ $class->id }}"
                                        @if (old('class_id') == $class->id)
                                            selected
                                        @endif
                                    >
                                        {{ $class->name }}
                                    </option>
                                @endforeach
                            </select>
                            @if ($errors->has('class_id'))
                                <div class="invalid-feedback">
                                    <strong>{{ $errors->first('class_id') }}</strong>
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="semester">Semester:</label>
                            <select class="form-control" id="semester" name="semester_id">
                                @foreach ($semesters as $semester)
                                    <option value="{{ $role->id }}"
                                        @if (old('role_id') == $role->id)
                                            selected
                                        @endif
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