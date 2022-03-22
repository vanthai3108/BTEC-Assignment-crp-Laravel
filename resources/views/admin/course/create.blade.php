@extends('adminlte::page')

@section('title', 'Admin | Create course')

@section('content_header')
    <a href="{{ route('admin.courses.index') }}" class="btn btn-info">Go Back</a>
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
                        <div class="card-body">
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
                                    <option value="{{ $semester->id }}"
                                        @if (old('semester_id') == $semester->id)
                                            selected
                                        @endif
                                    >
                                        {{ $semester->name }}
                                    </option>
                                @endforeach
                            </select>
                            @if ($errors->has('semester_id'))
                                <div class="invalid-feedback">
                                    <strong>{{ $errors->first('semester_id') }}</strong>
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="trainer">Trainer:</label>
                            <select class="form-control" id="trainer" name="trainer_id">
                                @foreach ($trainers as $trainer)
                                    <option value="{{ $trainer->id }}"
                                        @if (old('trainer_id') == $trainer->id)
                                            selected
                                        @endif
                                    >
                                        {{ $trainer->name }}
                                    </option>
                                @endforeach
                            </select>
                            @if ($errors->has('trainer_id'))
                                <div class="invalid-feedback">
                                    <strong>{{ $errors->first('trainer_id') }}</strong>
                                </div>
                            @endif
                        </div>
                        {{-- <div class="form-group">
                            <label for="date">Date:</label>
                            <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" 
                                id="date" name="name" value="{{ old('name') }}" placeholder="Enter class name">
                            @if ($errors->has('name'))
                                <div class="invalid-feedback">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </div>
                            @endif
                        </div> --}}
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